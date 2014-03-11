$(document).ready(function() {

//Запрос и получение дат новостей за месяц соответствующего года
    function requestData (month, year){
            $.ajax({
                    type: "GET",
                    url: "cal_req.php",
                    dataType: "json",
                    data: "year="+year+"&month="+month,
                    //делаем вместо асинхронного запроса, синхронный. 
                    //Иначе функция отключения дней disableAllTheseDays 
                    //не успевает получит данные с сервера.
                    //Увы, как мне кажется, проблемное место,
                    //не рекомендуют этого делать.
                    async:false,  
                    success: function (msg){ undisabledDays=msg; }
            });
    }
 
//Функция отключеня дней без статей, на календаре,
//вызывается для каждого дня
    function disableAllTheseDays(date) {
            date = $.datepicker.formatDate('yy-mm-dd', date);
            return [$.inArray(date, undisabledDays) !=-1];
      }
//Функция загрузки дат новостей для текущего месяца
//(при первичной загрузке календаря)    
    function loadCurrentPosts() {
        var curDate = new Date();
        var month = curDate.getMonth();
            month++;
        var year = curDate.getFullYear();
            requestData(month, year);
    }
//Функция загрузки дат новостей при переходе на следующий,
//(предыдущий) месяц.
    function loadIdPost(year, month){ requestData(month, year); }     
       
//Сам Datepicker    
    $('#datepickerevent').datepick({
    //перед загрузкой календаря получаем даты новостей для
   //текущего месяца
        beforeShow: loadCurrentPosts(),
    //выставляем удобный формат даты календаря, для передачи на сервер
        dateFormat: 'yy-mm-dd',
    //перед показом даты проверяем есть новости к дате или нет,
    //если нет то отключаем дату.
    //выполняется каждый раз при прорисовки календаря
    //(изменение месяца, обновление страницы). 
        beforeShowDay:  disableAllTheseDays, 
    //при изменении месяца получаем даты новостей для него
        onChangeMonthYear:  function(year, month, inst) {
                                    loadIdPost(year, month)},
    //при выборе даты, в данном случае открываем страницу
    //с новостями за этот день
        onSelect: function(date)
                        {
                        var links="arhiv2.php?dates=";
                        window.location.href = links+date;
                        }
          
    }); 
});