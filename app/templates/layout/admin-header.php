
<nav class="navbar navbar-inverse">
   <ul class="nav navbar-nav">
      <li class="active"><a href="../profile/">Perfil de admin</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tareas <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../listTask/">Lista de tareas</a></li>
          <li><a href="../addTask/">Crear tarea</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Clientes <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../listClient/">Lista de clientes</a></li>
          <li><a href="../addClient/">Crear cliente</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Técnicos <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../listTech/">Lista de técnicos</a></li>
          <li><a href="../addTech/">Crear técnico</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li ><a><form method="POST" action="../profile/">

    <input type="submit" name="logout" value="Cerrar sesión">
  </form></a></li>
      
    </ul>
  </div>
</nav>