function dancing(event, pixel){
		$(event.target).animate({top: pixel + 'px'}, function(){
		dancing(event, -pixel);
	});
}
$(document).ready(function(){
var speed=120;
$('#dance a').hover(function(event){
    	$(this).stop().animate({top: '-5px'}, speed, function(){
		dancing(event, 5);
	});
}, function(){
	$(this).stop().animate({top: '0'}, speed);
});

});

 $( function() {
    $('input[type="radio"]').checkboxradio({
      icon: false
    });
  } );
  
   $( function() {
    $('input[type="checkbox"]').checkboxradio({
      icon: false
    });
  } );
  
 $( function() {
    $( '#sortable').sortable({
      items: 'li:not(.ui-state-disabled)'
    });

  } );
  
  $(document).ready(function(){
	  $('.JSButton').css('display', 'block');
  });

$(document).ready(function() {

    $('.search-box input[type="text"]').on('keyup input', function () {

        var inputVal = $(this).val();

        if (inputVal.length) {
            $.get('AJAXSearch', {term: inputVal}).done(function(data){
                $('.result').html(data);
            });
        } else {
            $('.result').html('');
        }
    });
});