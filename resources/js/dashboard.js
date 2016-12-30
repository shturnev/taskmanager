$(document).ready(function () {

    var doughnutData = [
        {
            value: 0,
            color:"#d9534f",
            highlight: "#df5551",
            label: "Провалено"
        },
        {
            value: 0,
            color: "#5cb85c",
            highlight: "#68d168",
            label: "Выполнено"
        },
        {
            value: 0,
            color: "#777",
            highlight: "#8f8f8f",
            label: "В процессе"
        }

    ];


    $.post("/api", {"method_name" : "getTaskCount_forMe"}, function(d){
        var res = JSON.parse( d );
        if(res.error){ alert(res.error); return false; }

        doughnutData[0].value = +res.response.status_2;
        doughnutData[1].value = +res.response.status_1;
        doughnutData[2].value = +res.response.status_0;

        var chart3 = document.getElementById("doughnut-chart").getContext("2d");
        window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true});

    });


}); //Конец Ready