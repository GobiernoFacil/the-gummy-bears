// el script para el timer del inicio

var today    = new Date(),
    beta 	 = new Date(2016,0,23,8),
    clock    = document.querySelector("#countdown"),
    timer, html, interval;


if(today < beta){
  interval = setInterval(function(){
    var timespan = countdown(beta);
    html = "<p>" 
      +"<strong>" + timespan.months + "</strong> mes "
      +"<strong>" + timespan.days + "</strong> días "
      +"(<span class='number'>" + (timespan.hours < 10 ? "0" + String(timespan.hours) : timespan.hours) + "</span>:"
      +"<span class='number'>" + (timespan.minutes < 10 ? "0" + String(timespan.minutes) : timespan.minutes) + "</span>:"
      +"<span class='number'>" + (timespan.seconds < 10 ? "0" + String(timespan.seconds) : timespan.seconds) + "</span>)<br>"
      +"<small>para ver los primeros datos</small></p>";
    clock.innerHTML = html;

    if(!timespan.days && !timespan.hours && !timespan.minutes && timespan.seconds < 3){
      clearInterval(interval);
      clock.innerHTML = "Listo";
    }
  }, 1000);
}
else{
  clock.innerHTML = "";
}