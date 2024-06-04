import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import VisitTypeConst from "./constants";
import dayjs from "dayjs";

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");
    const calendar = new Calendar(calendarEl, {
        themeSystem: "bootstrap5",
        plugins: [interactionPlugin, dayGridPlugin],
        locale: "ja",
        // 設定しないのが正なのか少し怪しいため消さずにコメントアウト
        // timeZone: "Asia/Tokyo",
        initialView: "dayGridMonth",
        eventColor: "blue",
        headerToolbar: {
            center: "backEventButton addEventButton",
        },
        customButtons: {
            addEventButton: {
                text: "来訪予定登録",
                click: function () {
                    openModal();
                },
            },
            backEventButton: {
                text: "戻る",
                click: function () {
                    window.location.href = "/people";
                },
            },
        },
        dayMaxEvents: true, // 多数のイベントがある日に「もっと見る」リンクを表示
        eventDidMount: function (info) {
            function formatDate(date, is_end) {
                const dateString = date?.toLocaleString();
                if (/ 0:00:00$/.test(dateString)) {
                    return is_end
                        ? dayjs(dateString).subtract(1, "day").format("MM-DD")
                        : dayjs(dateString).format("MM-DD");
                } else {
                    return dayjs(dateString).format("MM-DD HH:mm");
                }
            }

            var tooltip = new bootstrap.Tooltip(info.el, {
                title: `${info.event.title}
                <br>来訪: ${formatDate(info.event.start, false)}
                <br>退館: ${formatDate(info.event.end, true)}`,
                placement: "top",
                trigger: "hover",
                container: "body",
                html: true,
            });
        },
        events: function (info, successCallback, failureCallback) {
            axios
                .get("/calendar/index_scheduled_visit")
                .then((response) => {
                    const schedules = response.data.contents.map((schedule) => {
                        // day.jsを使用して日付を処理
                        let startDate = dayjs(schedule.arrival_datetime);
                        let endDate = dayjs(schedule.exit_datetime);
                        let allDay = false;

                        // 到着日時が "00:00:00" で終わる場合
                        if (schedule.arrival_datetime.endsWith("00:00:00")) {
                            allDay = true; // 終日イベントとして設定
                        }

                        // 到退去日時が "00:00:00" で終わる場合にのみ処理を行う
                        if (schedule.exit_datetime.endsWith("00:00:00")) {
                            endDate = endDate.add(1, "day"); // 終了日を1日加算
                            allDay = true; // 終日イベントとして設定
                        }

                        return {
                            id: schedule.id,
                            title: `${schedule.person_name}
                            / ${VisitTypeConst.VISIT_TYPE_JA[schedule.type]}`,
                            start: startDate.format("YYYY-MM-DD HH:mm"),
                            end: endDate.format("YYYY-MM-DD HH:mm"),
                            allDay: allDay,
                        };
                    });
                    successCallback(schedules);
                })
                .catch((error) => {
                    failureCallback(error); // エラーを処理
                    console.error("Error fetching events:", error);
                });
        },
    });

    window.closeModal = closeModal;
    const closeButton = document.querySelector(".modal-close-btn");
    if (closeButton) {
        closeButton.addEventListener("click", closeModal);
    }

    // 登録ボタンのイベントリスナー設定
    registerSchedule();

    // 登録モーダルで表示する利用者名の選択肢を取得
    const selectPeople = document.getElementById("selectPeople");
    axios
        .get("/calendar/index_person")
        .then((response) => {
            if (response.status === 204) {
                return;
            }
            response.data.contents.forEach((person) => {
                const option = document.createElement("option");
                option.value = person.id;
                option.textContent = person.person_name;
                selectPeople.appendChild(option);
            });
        })
        .catch((error) => {
            console.error("Error fetching people:", error);
            alert("データの取得に失敗しました。");
        });

    // 登録モーダルで表示する訪問タイプの選択肢を取得
    const selectVisitType = document.getElementById("selectVisitType");
    axios
        .get("/calendar/index_visit_type")
        .then((response) => {
            response.data.contents.forEach((type) => {
                const option = document.createElement("option");
                option.value = type.id;
                option.textContent = VisitTypeConst.VISIT_TYPE_JA[type.type];
                selectVisitType.appendChild(option);
            });
        })
        .catch((error) => {
            console.error("Error fetching people:", error);
            alert("データの取得に失敗しました。");
        });

    // フォームの送信
    let originalData = {};
    function registerSchedule() {
        document
            .getElementById("eventForm")
            .addEventListener("submit", function (e) {
                e.preventDefault();
                const isEdit = submitButton.textContent === "編集する";
                const url = isEdit ? "/calendar/edit" : "/calendar/register";

                // フォームのデータを取得
                const peopleId = document.getElementById("selectPeople").value;
                const visitTypeId =
                    document.getElementById("selectVisitType").value;
                const arrivalDate =
                    document.getElementById("arrival-date").value;
                const arrivalTime = document.getElementById("arrival-time")
                    .value
                    ? document.getElementById("arrival-time").value
                    : "00:00";
                const arrivalDateTime = `${arrivalDate} ${arrivalTime}:00`;
                const exitDate = document.getElementById("exit-date").value;
                const exitTime = document.getElementById("exit-time").value
                    ? document.getElementById("exit-time").value
                    : "00:00";
                const exitDateTime = `${exitDate} ${exitTime}:00`;

                // 編集では変更があった項目のみを送信データに含める
                const dataToSend = {
                    people_id: peopleId,
                };
                if (isEdit) {
                    dataToSend.visit_type_id =
                        visitTypeId !== originalData.visit_type_id
                            ? visitTypeId
                            : null;
                    dataToSend.arrival_datetime =
                        arrivalDateTime !== originalData.arrival_datetime
                            ? arrivalDateTime
                            : null;
                    dataToSend.exit_datetime =
                        exitDateTime !== originalData.exit_datetime
                            ? exitDateTime
                            : null;
                    dataToSend.notes = null;
                } else {
                    dataToSend.visit_type_id = visitTypeId;
                    dataToSend.arrival_datetime = arrivalDateTime;
                    dataToSend.exit_datetime = exitDateTime;
                    dataToSend.notes = null;
                }

                axios
                    .post(url, dataToSend, {
                        headers: {
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        },
                    })
                    .then(() => {
                        let job = isEdit ? "編集" : "登録";
                        alert(`${job}しました`);
                        calendar.refetchEvents();
                    })
                    .catch((error) => {
                        alert("登録に失敗しました");
                    });

                closeModal();
            });
    }

    calendar.setOption("eventClick", function (info) {
        axios
            .get("/calendar/scheduled_visit_detail/", {
                params: {
                    scheduled_visit_id: info.event.id,
                },
            })
            .then((response) => {
                const schedule = response.data.contents;
                // オプション選択モーダルを表示
                document
                    .getElementById("optionModal")
                    .classList.remove("hidden");
                // 編集ボタンのイベントハンドラ
                document.getElementById("editButton").onclick = function () {
                    const eventData = {
                        person_id: schedule.people_id,
                        visit_type_id: schedule.visit_type_id,
                        start: info.event.start.toISOString(),
                        end: info.event.end.toISOString(),
                    };
                    // 編集モーダルを開く
                    openModal(true, eventData);
                    document
                        .getElementById("optionModal")
                        .classList.add("hidden");
                };

                // 削除ボタンのイベントハンドラ
                document.getElementById("deleteButton").onclick = function () {
                    openDeleteModal();
                    document
                        .getElementById("optionModal")
                        .classList.add("hidden");
                    document.getElementById("confirmDelete").onclick =
                        function () {
                            deleteEvent(info.event.id);
                            document
                                .getElementById("optionModal")
                                .classList.add("hidden");
                        };
                };
            })
            .catch((error) => {
                console.error("Error fetching event details:", error);
                alert("イベントデータの取得に失敗しました。");
            });
    });

    // 削除メソッド
    function deleteEvent(eventId) {
        axios
            .post(
                "/calendar/delete",
                {
                    schedule_id: eventId,
                },
                {
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                }
            )
            .then(() => {
                alert("予定が削除されました");
                closeDeleteModal();
                calendar.refetchEvents();
            })
            .catch((error) => {
                console.error("削除エラー:", error);
                alert("削除に失敗しました");
            });
    }

    calendar.render();
});

// スクロールバーの幅を計算
function getScrollbarWidth() {
    return window.innerWidth - document.documentElement.clientWidth;
}

// 予定登録・編集用のモーダル開く
function openModal(edit = false, eventData = null) {
    const scrollbarWidth = getScrollbarWidth();
    document.body.style.overflow = "hidden";
    document.body.style.paddingRight = `${scrollbarWidth}px`; // スクロールバーの幅を補正
    const modal = document.getElementById("modalBackdrop");
    const modalTitle = document.getElementById("modalTitle");
    const submitButton = document.getElementById("submitButton");
    if (edit) {
        modalTitle.textContent = "予定を編集";
        submitButton.textContent = "編集する";
        // ここでフォームに既存のデータをセットする
        document.getElementById("selectPeople").value = eventData.person_id;
        document.getElementById("selectVisitType").value =
            eventData.visit_type_id;
        document.getElementById("arrival-date").value = dayjs(
            eventData.start
        ).format("YYYY-MM-DD");
        document.getElementById("arrival-time").value = dayjs(
            eventData.start
        ).format("HH:mm");
        document.getElementById("exit-date").value = dayjs(
            eventData.end
        ).format("YYYY-MM-DD");
        document.getElementById("exit-time").value = dayjs(
            eventData.end
        ).format("HH:mm");
    } else {
        modalTitle.textContent = "来訪日登録";
        submitButton.textContent = "登録";
        // フォームの値をクリア
        document.getElementById("eventForm").reset();
    }

    modal.classList.remove("hidden");
}

// 登録モーダルを閉じる関数
function closeModal() {
    document.body.style.overflow = "";
    document.body.style.paddingRight = ""; // 補正を解除
    const modal = document.getElementById("modalBackdrop");
    modal.classList.add("hidden");
}

// 削除モーダル
function openDeleteModal() {
    document.getElementById("deleteModal").classList.remove("hidden");
}
const cancelDelete = document.getElementById("cancelDelete");
if (cancelDelete) {
    document
        .getElementById("cancelDelete")
        .addEventListener("click", function () {
            document.getElementById("deleteModal").classList.add("hidden");
        });
}
const cancelOption = document.getElementById("cancelOption");
if (cancelOption) {
    document
        .getElementById("cancelOption")
        .addEventListener("click", function () {
            document.getElementById("optionModal").classList.add("hidden");
        });
}

function closeDeleteModal() {
    document.body.style.overflow = "";
    document.body.style.paddingRight = ""; // 補正を解除
    const modal = document.getElementById("deleteModal");
    modal.classList.add("hidden");
}
