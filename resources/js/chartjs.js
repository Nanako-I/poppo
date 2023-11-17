// import Chart from "chart.js/auto";
import { Chart } from 'chart.js/auto';
Chart.defaults.font.size = 20; // デフォルトのフォントサイズを設定
Chart.defaults.font.color = 'rgb(0, 0, 0)'; // デフォルトのフォントカラーを設定

// Chart.defaults.font = {
//   family: "'Helvetica', 'Meiryo UI'",
//   size: 12,
//   style: 'normal',
//   weight: 'normal',
//   lineHeight: 1.2
// }

// const ctx = document.getElementById("myChart").getContext("2d");
// const myChart2 =  {
//     type: "bar",
//     data: {
//         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//         datasets: [
//             {
//                 label: "# of Votes",
//                 data: [12, 19, 3, 5, 2, 3],
//                 backgroundColor: [
//                     "rgba(255, 99, 132, 0.2)",
//                     "rgba(54, 162, 235, 0.2)",
//                     "rgba(255, 206, 86, 0.2)",
//                     "rgba(75, 192, 192, 0.2)",
//                     "rgba(153, 102, 255, 0.2)",
//                     "rgba(255, 159, 64, 0.2)",
//                 ],
//                 borderColor: [
//                     "rgba(255, 99, 132, 1)",
//                     "rgba(54, 162, 235, 1)",
//                     "rgba(255, 206, 86, 1)",
//                     "rgba(75, 192, 192, 1)",
//                     "rgba(153, 102, 255, 1)",
//                     "rgba(255, 159, 64, 1)",
//                 ],
//                 borderWidth: 1,
//             },
//         ],
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true,
//             },
//         },
//     },
// };
// let myChart = new Chart(ctx, myChart2);

// // import Chart2 from "chart.js/auto"; // 別の変数名で2つ目のChartをインポート
// import { Chart2 } from 'chart.js/auto';
// const ctx2 = document.getElementById("sampleChart").getContext("2d");
// const sampleChart2 =  {
//     type: "bar",
//     data: {
//         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//         datasets: [
//             {
//                 label: "# of Votes",
//                 data: [12, 19, 3, 5, 2, 3],
//                 backgroundColor: [
//                     "rgba(255, 99, 132, 0.2)",
//                     "rgba(54, 162, 235, 0.2)",
//                     "rgba(255, 206, 86, 0.2)",
//                     "rgba(75, 192, 192, 0.2)",
//                     "rgba(153, 102, 255, 0.2)",
//                     "rgba(255, 159, 64, 0.2)",
//                 ],
//                 borderColor: [
//                     "rgba(255, 99, 132, 1)",
//                     "rgba(54, 162, 235, 1)",
//                     "rgba(255, 206, 86, 1)",
//                     "rgba(75, 192, 192, 1)",
//                     "rgba(153, 102, 255, 1)",
//                     "rgba(255, 159, 64, 1)",
//                 ],
//                 borderWidth: 1,
//             },
//         ],
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true,
//             },
//         },
//     },
// };

// let sampleChart = new Chart(ctx2, sampleChart2);


import { Chart3 } from 'chart.js/auto';
    const ctx3 = document.getElementById("temperatureChart").getContext("2d");
    const chartElement = document.getElementById("temperatureChart");
    
    // JSON.parse は、JavaScriptでJSON形式の文字列をJavaScriptオブジェクトに変換するための組み込みの関数↓
    const chartLabels = JSON.parse(chartElement.getAttribute("data-labels"));
    const chartData = JSON.parse(chartElement.getAttribute("data-data"));
    
    function formatLabel(dateString) {
    const date = new Date(dateString);
    const options = {
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
    };
    return date.toLocaleDateString('ja-JP', options);
}
const formattedChartData = chartLabels.map(formatLabel);

    // 例: "2023-10-25 14:30:00" を "10月25日" のフォーマットに変換する関数
    // function formatDateToMonthDay(dateString) {
    //     const date = new Date(dateString);
    //     const month = (date.getMonth() + 1).toString().padStart(2, '0'); // 月を2桁の文字列に
    //     const day = date.getDate().toString().padStart(2, '0'); // 日を2桁の文字列に
    //     return `${month}月${day}日`;
    // }

    // // chartDataの日付データを変換　// この時点で、formattedChartData は ["10月25日", "10月26日", ...] のような形式になる
    // const formattedChartData = chartData.map(dateString => formatDateToMonthDay(dateString));
    // // chartDataに含まれる日付データを日付順にソート
    // chartData.sort((a, b) => new Date(a) - new Date(b));


if (chartLabels && chartData) {
    const data = {
        labels: formattedChartData,
        // labels: formattedChartData, // 変換後の日付データを使用
        datasets: [{
            label: '体温',
            data: chartData,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            borderWidth: 1
        }]
    };

    const config = {
    type: 'line',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: false, // 0からではなく、35から始まるように設定
                suggestedMin: 30,   // 最小値を35に設定
                suggestedMax: 40    // 最大値を50に設定
            }
        }
    }
};


var temperatureChart = new Chart(ctx3, config);
};



import { Chart4 } from 'chart.js/auto';
    const ctx4 = document.getElementById("benChart").getContext("2d");
    const benChartElement = document.getElementById("benChart");
    
    // JSON.parse は、JavaScriptでJSON形式の文字列をJavaScriptオブジェクトに変換するための組み込みの関数↓
    const benchartLabels = JSON.parse(benChartElement.getAttribute("data-ben-labels"));
    // const benchartData = JSON.parse(benChartElement.getAttribute("data-ben-data"));
    const benData = JSON.parse(benChartElement.getAttribute("data-ben-data"));
    const bentsuuData = JSON.parse(benChartElement.getAttribute("data-ben-bentsuu"));
    

// カテゴリーを数値に変換
const convertedData = benData.map(category => {
  if (category === 'many') {
    return 1.5;
  } else if (category === 'normal') {
    return 1.0;
  } else if (category === 'less') {
    return 0.5;
  } else {
    return null;
  }
});


const bentsuuLabels = bentsuuData.map(value => {
  if (value === 'kanchou') {
    return '浣腸';
  } else if (value === 'gezai') {
    return '下剤';
  } else if (value === 'tekiben') {
    return '摘便';
  } else {
    return null;
  }
  
});



if (benchartLabels && convertedData) {
  const bendata = {
    labels: bentsuuLabels, // bentsuu の日本語表記をX軸に表示
    
        datasets: [
            {
                label: '排便量',
                data: convertedData,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                // backgroundColor: 'rgba(75, 192, 192, 0.2)',
                // borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            
            
           
        ]
    };

    const benconfig = {
        type: 'line',
        data: bendata,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 2.0, 
                    ticks: {
                        stepSize: 0.5, // y軸の刻み幅を設定
                        callback: function (value, index, values) {
                            if (value === 0.5) {
                                return '少';
                            } else if (value === 1.0) {
                                return '普通';
                            } else if (value === 1.5) {
                                return '多';
                            } else {
                                return '';
                            }
                        }
                    }
                }
            }
        }
    };

    var benChart = new Chart(ctx4, benconfig);
}
import { Chart5 } from 'chart.js/auto';
    
 document.addEventListener("DOMContentLoaded", function() {
     const ctx5 = document.getElementById("benConditionChart").getContext("2d");
   
    // JSON.parse は、JavaScriptでJSON形式の文字列をJavaScriptオブジェクトに変換するための組み込みの関数↓
    // const benchartData = JSON.parse(benChartElement.getAttribute("data-ben-data"));
    const benConditionChartElement = document.getElementById("benConditionChart");
    const benLabelData = JSON.parse(benConditionChartElement.getAttribute("data-ben-labels"));
    const benConditionData = JSON.parse(benConditionChartElement.getAttribute("data-ben-condition"));
//   alert(benConditionData['普通便'].length);
    
    // const benConditionData = benConditionChartElement.getAttribute("data-ben-condition");
    // const benConditionDataJSON = benConditionChartElement.getAttribute("data-ben-condition");
    // const benJSONData = JSON.parse(benConditionDataJSON);
    // const decodedLabelData = benLabelData.replace(/&quot;/g, '"');
    // const decodedLabelCondition = benConditionData.replace(/&quot;/g, '"');
    
    // benConditionData を JSON パースして配列に変換
    // const benConditionArray = JSON.parse(decodedLabelCondition);
    // その他の処理
    // 例: データベースからデータを取得
    // if (Array.isArray(benJSONData)) {
  // `benJSONData` が配列であることを確認

const colors = {
    "硬便": 'rgb(255, 99, 132)',
    "普通便": 'rgb(255, 159, 64)',
    "軟便": 'rgb(255, 205, 86)',
    "泥状便": 'rgb(75, 192, 192)',
    "水様便": 'rgb(54, 162, 235)'
    
    // 他の条件やデータにも色を追加
};
   const benConditionLabels = Object.keys(benConditionData);
// const benConditionLabels = benConditionData.map(value => {
//   if (value === '硬便') {
//     return '硬便';
//   } else if (value === '普通便') {
//     return '普通便';
//   } else if (value === '軟便') {
//     return '軟便';
//   } else if (value === '泥状便') {
//     return '泥状便';
//   } else if (value === '水様便') {
//     return '水様便'; 
//   } else if (value === 'kouben') {
//     return 'kouben';
//   } else {
//     return null;
//   }
// });

const defaultColor = 'rgb(255, 99, 132)';

if (benLabelData) {
    const conditionColors = benConditionLabels.map(label => colors[label] || defaultColor);
    // 条件がnullの場合、defaultColorが使われます

// const conditionColors = benConditionLabels.map(label => colors[label]);

// const defaultColor = 'rgb(201, 203, 207)';

// if (benLabelData) {
//     // benConditionDataがnullまたはselectedの場合、デフォルトの色を設定
//     if (benConditionData == null || benConditionData === "selected") {
//         conditionColors = benConditionLabels.map(_ => defaultColor);
//     }


if (benLabelData && benConditionData) {
     // {"普通便":[1,2,3,4,5],"硬便":[1,2,3,4,5],"軟便":[1,2,3,4,5]}のobjectだけを取る
    const l= Object.values(benConditionData);
//   const l_count = labels.map(label => benConditionData[label].length);
    const l_count = l.map(condition =>condition.length);
    // 二重配列をmapする　配列を一つひとつ0番目、condition＝配列
   const ConditionData = {
      labels: benConditionLabels,  // 各データポイントに対するラベル
  
    //   data: l,//Array(benConditionData.length).fill(1),  
      datasets: [
        {
        //   label:[ '硬便','普通便','軟便','泥状便','水様便'],
          data: l_count,  // 各データポイントの値（1として表示）
       　　backgroundColor: conditionColors,
        //   backgroundColor: ['rgb(255, 99, 132)',
        //                     'rgb(255, 159, 64)',
        //                     'rgb(255, 205, 86)',
        //                     'rgb(75, 192, 192)',
        //                     'rgb(54, 162, 235)',
        //                     'rgb(153, 102, 255)',
        //                      'rgb(201, 203, 207)'
        //                   ],
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
         
        }
      ]
    };


   const conditionconfig = {
        type: 'pie',
        data: ConditionData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    var benConditionChart = new Chart(ctx5, conditionconfig);
}
}
});
import { Chart6 } from 'chart.js/auto';
    const ctx6 = document.getElementById("foodChart").getContext("2d");
    const foodchartElement = document.getElementById("foodChart");
    
    // JSON.parse は、JavaScriptでJSON形式の文字列をJavaScriptオブジェクトに変換するための組み込みの関数↓
    const foodchartLabels = JSON.parse(foodchartElement.getAttribute("data-food-labels"));
    const foodStapleData = JSON.parse(foodchartElement.getAttribute("data-staple_food"));
    const foodSideDish = JSON.parse(foodchartElement.getAttribute("data-side_dish"));

 function formatFoodLabel(dateString) {
    const date = new Date(dateString);
    const options = {
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
    };
    return date.toLocaleDateString('ja-JP', options);
}
const formattedFoodData = foodchartLabels.map(formatFoodLabel);

if (foodchartLabels && foodStapleData  && foodSideDish) {
    const fooddata = {
        // type: 'line',
        labels: formattedFoodData,
        // labels: formattedChartData, // 変換後の日付データを使用
        datasets: [{
            
            label: '主食',
            data: foodStapleData,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            borderWidth: 1
            
        },
         {
            //  type: 'line',
            label: '副食',
            data: foodSideDish,
            backgroundColor: 'rgb(75, 192, 192)',
            borderColor: 'rgb(75, 192, 192)',
            borderWidth: 1
        }]
    };

    const foodconfig = {
        type: 'line',
        data: fooddata,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };


var foodChart = new Chart(ctx6, foodconfig);
};