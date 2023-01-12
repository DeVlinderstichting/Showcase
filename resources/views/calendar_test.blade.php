<style>
    .calendarbackground{
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 200px;
        background-size: cover;
    }
    .calendardiv{
        position: relative;
        height: 200px;
    }
    table{
        width: 100%;
        height: 100%;
        position: absolute;
        box-shadow: inset 0px 0px 0px 4px black;
    }
    .calday{
       
    }
</style>

<script>
    var selectedMonthMod = 0;
</script>

<button type="button" onclick="selectedMonthMod--;renderCalendar();">Previous month</button> 
<div id="theMonth"> </div>
<button type="button" onclick="selectedMonthMod++;renderCalendar();">Next month</button> 
<div class="calendardiv my-3"> 
    <div class="calendarbackground"></div>
    <table class="table" id="calendar"></table>
</div>
<script type="text/javascript">
    function toTwoDigits(number)
    {
        return (Math.round(number * 100)/100).toFixed(2)
    }
</script>
<script>

    var selectedDate = null;
    function getDaysInMonth(mod) //get current month by default, pass it -1 or +1 to get prev or next month
    {
        let date = new Date();
        return new Date(
            date.getFullYear(),
            date.getMonth() + 1 + mod,
            0
        ).getDate();
    }
    function getDayOfWeekOfFirstDayOfMonth(mod) //same, 0 for current month, else -1 or +1 etc
    {
        let date = new Date();
        var d = new Date(
            date.getFullYear(),
            date.getMonth() + 1 + mod,
            0
        );
        let resD = d.getDay()-1;
        if (resD < 0)
        {
            resD = 6;
        }
        return resD;
    }

    const monthNames = ["Januari", "Februari", "Maart", "April", "Mei", "Juni", "July", "Augustus", "September", "Oktober", "November", "December"];

    var firstCalendarDate = null;
    var secondCalendarDate = null;

    var theItemDates = [];
    theItemDates['2022-12-30'] = "The 1 test item";
    theItemDates['2023-01-13'] = "The 2 test item";
    theItemDates['2023-01-20'] = "The 3 test item";

    function renderCalendar()
    {
        var elem = document.getElementById('calendar');
        var innerHtml = "";
        var beginPad = [];
        var dates = [];
        var endPad = [];

        var monthShow = document.getElementById('theMonth');
        let date = new Date();

        monthNr = (date.getMonth()+selectedMonthMod)%12;
        if (monthNr < 0)
        {
            while (monthNr < 0)
            {
                monthNr +=12;
            }
        }
        monthShow.innerHTML = monthNames[monthNr];

        for (var i =0; i < getDaysInMonth(selectedMonthMod); i++)
        {
            dates.push(i+1);
        }
        var firstDayNum = getDayOfWeekOfFirstDayOfMonth(selectedMonthMod-1);
        if (firstDayNum != 6) //zero based, if 6 the first is on monday, hence skip prev month
        {
            var prevMonthDays = getDaysInMonth(selectedMonthMod -1);
            for (var d = firstDayNum; d >= 0; d--)
            {
                beginPad.push(prevMonthDays - d);
            }
        }

        firstCalendarDate = new Date();
        firstCalendarDate.setMonth(firstCalendarDate.getMonth() + -1 + selectedMonthMod);
        if (beginPad.length > 0)
        {
            firstCalendarDate.setDate(beginPad[0]);
        }
        else
        {
            firstCalendarDate.setDate(1);
        }

        innerHtml = "<tr><th>Maandag</th><th>Dinsdag</th><th>Woensdag</th><th>Donderdag</th><th>Vrijdag</th><th>Zaterdag</th><th>Zondag</th></tr><tr >"
        let walkie = 0;

        for(let i = 0; i < beginPad.length; i++)
        {
            var cssAddition = getCssClass(-1, beginPad[i]);
            var dateForId = new Date();
            dateForId.setMonth(dateForId.getMonth() + -1 + selectedMonthMod);
            dateForId.setDate(beginPad[i]);
            //innerHtml += "<td id='tr_"+dateForId.toISOString().split('T')[0]+"' class = '"+cssAddition+"' onclick='selectDate(" + beginPad[i] + ",-1);'>" + '<span class="calday">'+beginPad[i] +'</span>' + "<canvas class='calcanvas' id='canvas_"+dateForId.toISOString().split('T')[0]+"'></canvas></td>";
            innerHtml += "<td style='color:gray' id='tr_"+dateForId.toISOString().split('T')[0]+"' onclick='selectDate(" + beginPad[i] + ",-1);'>" + '<center>'+ beginPad[i] +'</center>' + "</td>";
            walkie++;
        }
        for(let i = 0; i < dates.length; i++)
        {
            var cssAddition = getCssClass(0, dates[i]);
            var dateForId = new Date();
            dateForId.setMonth(dateForId.getMonth() + selectedMonthMod);
            dateForId.setDate(dates[i]);
            innerHtml += "<td id='tr_"+dateForId.toISOString().split('T')[0]+"' class = '"+cssAddition+"' onclick='selectDate(" + dates[i] + ",0);'>" + '<center>'+dates[i] +'</center>' + "</td>";
            if (walkie == 6)
            {
                innerHtml += "</tr><tr>";
                walkie = 0;
            }
            else 
            {   
                walkie++;
            }
        }
        if (walkie != 0)
        {
            for(let i = 1; walkie < 7; i++)
            {
                secondCalendarDate = new Date();
                secondCalendarDate.setMonth(secondCalendarDate.getMonth() + 1 + selectedMonthMod);
                secondCalendarDate.setDate(i);
                var cssAddition = getCssClass(1, i);
                innerHtml += "<td style='color:gray' id='tr_"+secondCalendarDate.toISOString().split('T')[0]+"' class = '"+cssAddition+"' onclick='selectDate(" + i + ",+1);'>" + '<center>'+i +'<center>' + "</td>";
                walkie++;
            }
        }
        innerHtml += "</tr>";
        elem.innerHTML = innerHtml;

        var theNow = new Date();
        var theNowStr = theNow.getFullYear() + "-" + (theNow.getMonth() + 1) + "-" + theNow.getDate();

        var nowElem = document.getElementById('tr_' + theNow.toISOString().split('T')[0]);
        if (nowElem != null)
        {
            nowElem.style.backgroundColor = 'lightgreen';
        }

        for(var key in theItemDates)
        {
            var nowElem = document.getElementById('tr_' + key);
            if (nowElem != null)
            {
                var day = key.substr(8,2);
                nowElem.innerHTML = "<center>" + day + "<br><img onclick='openPackage(\"" + key + "\");' src='images/giftPackage.jpg' style='height:45px;width:45px'>";
            }
        }
    }

    function openPackage(indexDate)
    {
        var date1 = new Date(indexDate);
        var nowDate = new Date();
        if (date1 < nowDate)
        {
            alert(theItemDates[indexDate]);
        }
        else 
        {
           // alert("Dit pakket kan nog niet worden geopend");
        }
    }

    function getCssClass(monthMod, day)
    {
        return "";
    }

    function selectDate(dayNum, monthMod)
    {
        selectedDate = new Date();
        selectedDate.setMonth(selectedDate.getMonth() + monthMod);
        selectedDate.setDate(dayNum);
        renderCalendar();
    }
</script>


<script type="text/javascript">
    
    function init()
    {
        renderCalendar();
    }
    init();

</script>
