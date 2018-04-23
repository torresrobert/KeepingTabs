<div class="text-center bg-white pt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-3">
          <p class="text-center text-muted">© Copyright 2018 KeepingTabs - All rights reserved. </p>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.0.0/dt-1.10.16/datatables.min.js">
</script>


<script>
  $('#journal').DataTable( {
      "order": [[ 3, "asc" ]]
  } );
</script>
<script>
  $('#account_view').DataTable( {
      "order": [[ 1, "asc" ]]
  } );
</script>
<script>
$("#user_dir").DataTable({
}
);

</script>
<script>
$("#journalize").DataTable({
          "order": [[ 1, "desc" ]]
});
</script>
<script>
$("#chart_of_accounts").DataTable({
  "columnDefs": [ {
      "targets": 6,
      "searchable": false
    } ]
} );
</script>
<script>
$("#accounts").DataTable({
  "columnDefs": [
    { "searchable": false, "targets": 7 }
  ]
} );
</script>
<script>
$("#balance_sheet").DataTable({
  "columnDefs": [
    { "searchable": false, "targets": 7 }
  ]
} );
</script>
<script>
$( function() {
  $( "#datepicker" ).datepicker();
} );
</script>
<script>
$(function() {
  $("#dialog").dialog({
    autoOpen: false
  });
  $("#button").on("click", function() {
    $("#dialog").dialog("open");
  });
});
</script>


<script type="text/javascript">
    $(function () {
        $(".identifyingClass").click(function () {
            var my_id_value = $(this).data('id');
            $(".modal-body #hiddenValue").val(my_id_value);
        })
    });
</script>




<script>
var ctx = document.getElementById("expensesBar").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ["Cash", "", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
<script>
var ctx = document.getElementById("myChart1").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Cash", "", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

</body>

</html>
