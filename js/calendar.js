$(document).ready(function() {

    function requestData (month, year){
            $.ajax({
                    async: false,
                    type: "GET",
                    dataType: "json",
                    url: base_url+"calendar/get_dates",
                    data: "year="+year+"&month="+month, 
                    success: function (msg){ undisabledDays=msg; }
            });
    }
//Функция отключеня дней без статей, на календаре,
    function disableAllTheseDays(date) {
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [$.inArray(string, undisabledDays) !=-1];
      }
//Функция загрузки дат новостей для текущего месяца   
    function loadCurrentPosts() {
        var curDate = new Date();
        var month = curDate.getMonth();
            month++;
        var year = curDate.getFullYear();
            requestData(month, year);
    }
//Функция загрузки дат новостей при переходе на следующий,
    function loadIdPost(year, month){ requestData(month, year); }     
           
    $('#datepickerevent').datepicker({
    //перед загрузкой календаря получаем даты новостей для
        beforeShow: loadCurrentPosts(),
    //выставляем удобный формат даты календаря, для передачи на сервер
        dateFormat: 'yy-mm-dd',
    //перед показом даты проверяем есть новости к дате или нет, 
        beforeShowDay:  disableAllTheseDays, 
    //при изменении месяца получаем даты новостей для него
        onChangeMonthYear:  function(year, month, inst) {
                                    loadIdPost(year, month)},
    //при выборе даты, в данном случае открываем страницу
        onSelect: function(date)
                        {
                        var links="calendar?dates=";
                        window.location.href = links+date;
                        }
          
    }); 
}); 