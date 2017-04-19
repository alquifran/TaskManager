<h1 class="welcome">Bienvenido <?=$admin->getName();?></h1><br>
<?php
use TaskManager\Model\Tech;
use TaskManager\Model\Task;
use TaskManager\Model\Client;

$techs = Tech::listTech(); 
$tasks = Task::listTasks(); 
$clients = Client::listClient();

$tech_times = [];
$task_status = [];
$task_client = [];

// Tiempo acumulado de cada técnico
foreach ($techs as $tech) {
	$namesTech = $tech->getName();
	$timesTech = Task::sumAllTechTime($tech->getId());

	
	array_push($tech_times, ["$namesTech",$timesTech]);
	

}
// Lista de Tareas/estado
foreach ($tasks as $task) {
	$namesTask = $task->getName();
	$statusTask = $task->getStatus();
	$statusTaskText = $task->getStatusText();

	array_push($task_status, ["$namesTask",(int)$statusTask]);
}

// Lista de tarea/estado por cliente (en construcción)
foreach ($clients as $client) {
  $taskClientId = Task::listTasksByClientId($client->getId());
  if (is_array($taskClientId) || is_object($taskClientId)){
    foreach ($taskClientId as $task) {
      $taskClient = $task->getName();
      $taskStatus = $task->getStatus();
      $nameClient = $client->getName();
      array_push($task_client, [$nameClient,$taskClient,(int)$taskStatus]);
    }
  } 
    
    

}


// array_unshift($task_status, ['Tarea','Estado']);
$task = json_encode($task_status);
// array_unshift($tech_times, ['Tiempo','Minutos']);
$tech = json_encode($tech_times);

$task_status_client = json_encode($task_client);
// var_dump($task);
// echo "<br>";
// var_dump($tech);
// var_dump($task_status_client);
?>

	

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      
      google.charts.load('current', {'packages':['corechart','table']});

      
      google.charts.setOnLoadCallback(tech_time);

      google.charts.setOnLoadCallback(status);
      
      google.charts.setOnLoadCallback(task_status);

      google.charts.setOnLoadCallback(task_client);

      
      function tech_time() {

        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Técnico');
        data.addColumn('number', 'Minutos');
        data.addRows(<?=$tech?>);

        
        var options = {title:'Técnico/Minuto',
                       width:400,
                       height:300,legend: { position: 'bottom' },

        vAxis: {minValue: 0, maxValue: 100},};
        
        var chart = new google.visualization.ColumnChart(document.getElementById('tech_time'));
        chart.draw(data, options);
      }

      function status(){
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Estado');
        data.addColumn('number', 'Valor');

        data.addRows([
          ["Por empezar",0],
          ["Haciéndose",1],
          ["Terminada",2]
          ]);
        var options = {title:'Estado/Valor',
                       width:400,
                       height:300,legend: { position: 'bottom' },};

        var chart = new google.visualization.ColumnChart(document.getElementById('status'));
        chart.draw(data, options);
      }
      
      function task_status() {

        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tarea');
        data.addColumn('number', 'Estado');
        // data.addColumn('number', 'Estado');
        data.addRows(<?=$task?>);

        
        var options = {title:'Estado de las tareas',
                       width:400,
                       height:300,legend: { position: 'bottom' },
        vAxis: {minValue: 0, maxValue: 2},};

        
        var chart = new google.visualization.ColumnChart(document.getElementById('task_status'));
        chart.draw(data, options);
      }

      function task_client(){
        var data = new google.visualization.DataTable();
        data.addColumn('string','Cliente');
        data.addColumn('string','Tarea');
        data.addColumn('number','Estado');

        data.addRows(<?=$task_status_client?>);

        var options = {title:'Estado de las tareas de clientes',
                       width:400,
                       height:300,legend: { position: 'bottom' },};

        var chart = new google.visualization.Table(document.getElementById('task_status_client'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    
    <table class="columns">
    <th>Tiempo consumido de cada técnico</th>
    <th>Valor de cada estado</th>
    <th>Estado de cada tarea</th>

      <tr>
        <td><div id="tech_time" style="border: 1px solid #ccc"></div></td>
        <td><div id="status" style="border: 1px solid #ccc"></div></td>
        <td><div id="task_status" style="border: 1px solid #ccc"></div></td>
        
      </tr>
      <th>Estado de cada tarea de cada cliente</th>
      <tr>

        <td><div id="task_status_client" style="border: 1px solid #ccc"></div></td>
      </tr>
        
    </table>
  </body>
</html>

	

	


