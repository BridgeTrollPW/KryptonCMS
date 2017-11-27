<?php
namespace Krypton\installer;

$returnMsg = 'No Post action provided';
if (isset($_POST['action'])) {
    $request = json_decode($_POST['action'], true);
    switch ($request[0]) {
    case '1':
    $returnMsg = 'Establish Database conntention with credentials<br>';
    $returnMsg .= '
    <div class="divider"></div>
    <form class="form-horizontal">
      <div class="form-group">
        <div class="col-3">
          <label class="form-label" for="input-host">Host</label>
          <label class="form-label" for="input-db">Database</label>
          <label class="form-label" for="input-user">User</label>
          <label class="form-label" for="input-pw">Password</label>
        </div>
        <div class="col-9">
          <input class="form-input" type="text" id="input-host" placeholder="Host" required>
          <input class="form-input" type="text" id="input-db" placeholder="Database" required>
          <input class="form-input" type="text" id="input-user" placeholder="User" required>
          <input class="form-input" type="password" id="input-pw" placeholder="Password" required>
        </div>
      </div>
      <!-- form structure -->
    </form>
    ';
    break;
    case '2':
    $returnMsg = 'Create an administrator user';
    $host = $request[1][0];
    $database = $request[1][1];
    $user = $request[1][2];
    $password = $request[1][3];

    $port = '';

    $dsn = 'mysql:dbname=' . $database . ';host=' . $host . ';port=' . $port;
    try {
        $PDOHandle = new \PDO($dsn, $user, $password);
    } catch (\PDOException $e) {
        echo json_encode(['error',$e->getMessage()]);
        die();
    }
    //return form for admin user
    $returnMsg .= '
    <div class="divider"></div>
    <form class="form-horizontal">
      <div class="form-group">
        <div class="col-3">
          <label class="form-label" for="input-user">Admin User</label>
          <label class="form-label" for="input-pw">Password</label>
        </div>
        <div class="col-9">
          <input class="form-input" type="text" id="input-user" placeholder="User" required>
          <input class="form-input" type="password" id="input-pw" placeholder="Password" required>
        </div>
      </div>
      <!-- form structure -->
    </form>
    ';
    break;
    case '3':
    $returnMsg = 'Try create user, if true: Do some system&securety related settings(Updates, Serialkey, ) ? if false: go back';
    break;
    case '4':
    $returnMsg = 'Check for Serialkey and updates via curl';
    break;
    case '5':
    $returnMsg = 'If all alright, create tables with default values and add admin user';
    break;
    default:
    $returnMsg = 'Something went wrong{'.$_POST['action'];
    break;
  }
}
echo $returnMsg;
