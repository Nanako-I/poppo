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
            center: "addEventButton",
        },
        customButtons: {
            addEventButton: {
                text: "来訪予定登録",
                click: function () {
                    openModal();
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
            console.log(formatDate(info.event.end));

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
    function registerSchedule() {
        document
            .getElementById("eventForm")
            .addEventListener("submit", function (e) {
                e.preventDefault();

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
                // 備考は使いたいけどツールチップでの表示が上手くいってないため一旦コメントアウト
                // const notes = document.getElementById("notes").value
                //     ? document.getElementById("notes").value
                //     : null;

                axios
                    .post(
                        "/calendar/register",
                        {
                            people_id: peopleId,
                            visit_type_id: visitTypeId,
                            arrival_datetime: arrivalDateTime,
                            exit_datetime: exitDateTime,
                            notes: null,
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
                        alert("登録しました");
                        calendar.refetchEvents();
                    })
                    .catch((error) => {
                        // バリデーションエラーなど
                        alert("登録に失敗しました");
                    });

                // モーダルを閉じる
                closeModal();
            });
    }

    calendar.setOption("eventClick", function (info) {
        // 削除モーダルを表示
        openDeleteModal();
        // 削除確認ボタンにイベントハンドラを設定
        document.getElementById("confirmDelete").onclick = function () {
            deleteEvent(info.event.id);
        };
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

// 登録モーダルを開く関数
function openModal() {
    const scrollbarWidth = getScrollbarWidth();
    document.body.style.overflow = "hidden";
    document.body.style.paddingRight = `${scrollbarWidth}px`; // スクロールバーの幅を補正
    // モーダルの要素を取得
    const modal = document.getElementById("modalBackdrop");
    // モーダルを表示
    modal.classList.remove("hidden");
}

// 登録モーダルを閉じる関数
function closeModal() {
    document.body.style.overflow = "";
    document.body.style.paddingRight = ""; // 補正を解除
    const modal = document.getElementById("modalBackdrop");
    modal.classList.add("hidden");
}

// 削除モーダルを開く関数
function openDeleteModal() {
    document.getElementById("deleteModal").classList.remove("hidden");
}
document.getElementById("cancelDelete").addEventListener("click", function () {
    document.getElementById("deleteModal").classList.add("hidden");
});

function closeDeleteModal() {
    document.body.style.overflow = "";
    document.body.style.paddingRight = ""; // 補正を解除
    const modal = document.getElementById("deleteModal");
    modal.classList.add("hidden");
}
