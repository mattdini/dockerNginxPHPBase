<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Project List Checker</title>

    <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/b-1.2.4/b-colvis-1.2.4/b-flash-1.2.4/b-html5-1.2.4/cr-1.3.2/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/b-1.2.4/b-colvis-1.2.4/b-flash-1.2.4/b-html5-1.2.4/cr-1.3.2/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/b-1.2.4/b-colvis-1.2.4/b-flash-1.2.4/b-html5-1.2.4/cr-1.3.2/datatables.min.css"/>


    <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> 

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <script>
        $(document).ready( function () {
            $('#mainTable').dataTable( {
                "paging":   false,
                "dom": '<"top"Bi><"top"flp>rt<"clear">',
                "columnDefs": [
                        { "type": "num", "targets": 8 }
                ],
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: "thead th:not(.noExport)"  //add class to thead to hide from export: <th class="noExport">Vision Name</th>
                        }
                    }
                ]
            } );

            $( ".buttons-csv" ).hide();

            $('#exportButton').on('click', function() {
                $('.buttons-csv').click()
            });


        } );



    </script>

    <style>
        body, td        { font-family: 'Roboto', sans-serif; font-size: 13px; font-weight: normal; color: #333;
                        line-height: 17px; }

        #logoimg{
                margin-top: -30px;
        }

        #navContent{
            /*margin-top: 8px;*/
        }

        .navTitle{
            color: white;
            font-size: 4em;
            font-family: 'Fredericka the Great', sans-serif;
            padding-right: 30px;
        }

        .centerButton {
            display: flex;
            align-items: center;
            padding-top: 300px;
            align:center;
        }

        .found{
            color:green;
        }


    </style>

  </head>
  <body>

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
      <a class="navbar-brand" href="#"><img src="listtop.png" id="logoimg"></a>
      <div id="navContent">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="#"><span class="navTitle">Project List Checker</span></a></li>
      </ul>

        <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-default btn-md"><span class="glyphicon glyphicon-about" aria-hidden="true"></span>About</button></a></li>
        
      </ul>


      </div>
      
  </div><!-- /.container-fluid -->
</nav>



</body>

<div class="row">


    <div class="col-md-2">&nbsp;</div>


    <div class="col-md-3"> <div class="form-group">
    <label for="comment">Project Numbers:</label>
    <textarea id="textAreaFrom" class="form-control" rows="30" id="comment">142640</textarea>
    </div> </div>


    <div class="col-md-1 centerButton">
    <a href="#"><button type="button" id="lookupButton" class="btn btn-success btn-md"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>Lookup</button></a>

    </div>


    <div class="col-md-6"> <div class="form-group">
    <label for="comment">Status:</label>
    <div id="outputDiv">---</div>
    </div> </div>





</div>



<script>

$( "#lookupButton" ).click(function() {
    $('#outputDiv').html('');
    var tableHTML = "<table class=\"table table-striped\"><thead><tr><th>Status</th><th>Number</th><th>Name</th></tr></thead>";

    var lines = $('#textAreaFrom').val().split('\n');

    for(var i = 0;i < lines.length;i++){
        console.log(lines[i]);

        $.ajax({url: "http://corpweb.pdx.amaa.com/api/projectDetails.php?term=" + lines[i] , async:false, success: function(result){
            console.log(result);
            if(result['Status']){
               //$('#textAreaTo').val($('#textAreaTo').val()+result['Status'] + "\n");
               tableHTML = tableHTML + "<tr><td>"+ result['Status'] +"</td><td>"+ result['WBS1'] +"</td><td>"+ result['Name'] +"</td></tr>"; 
            }else{
                tableHTML = tableHTML +" <tr><td>NF</td><td></td><td></td></tr>";
            }
            
        }});

    }

   $( "#outputDiv" ).append(tableHTML); 
});

</script>



</html>