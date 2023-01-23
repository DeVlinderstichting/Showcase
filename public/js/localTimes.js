function toLocalDatetime(strTime)  // Takes DST into account
{
    let date = Date.parse(strTime);
    let localOffsetMs =  new Date(strTime).getTimezoneOffset() * 60 * 1000;
    date = new Date(date - localOffsetMs);
    dateLocal =
      date.getFullYear() + "-" +
      ("00" + (date.getMonth() + 1)).slice(-2) + "-" +
      ("00" + date.getDate()).slice(-2) + " " +
      ("00" + date.getHours()).slice(-2) + ":" +
      ("00" + date.getMinutes()).slice(-2) + ":" +
      ("00" + date.getSeconds()).slice(-2);
    return dateLocal;
}        

/**
 * Display all times on a page in local time.
 * All text between <time> tags is replaced with a localised
 */
function timesToLocal()
{
    let allTimeTags = document.getElementsByTagName("time");
    for (let i=0; i < allTimeTags.length; i++)
    {
        let serverTime = allTimeTags[i].innerHTML;
        console.log(serverTime);
        allTimeTags[i].innerHTML = toLocalDatetime(serverTime);
    }
}