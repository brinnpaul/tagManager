<script>
  $(document).ready(function() {
    $('#datatables').dataTable( {
      "sScrollY": "500px"
    } );
  } );

  // $('#datatables').DataTable( {
  //   scrollY: 200,
  // } );

  $('.nav li').click(function() {
      $('.nav li').removeClass('selected');
      $(this).addClass('selected');
  });

  $(document).ready(function () {
        if(window.location.href.indexOf("active"))
        {
             $(".nav li#active").addClass("selected");
        }
        else if(window.location.href.indexOf("archive"))
        {
             $(".nav li#archive").addClass("selected");
        }

    });
</script>
