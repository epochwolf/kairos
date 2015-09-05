<? isset($CONFIG) or die("Fatal: _includes/framework.php wasn't included."); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <? // Tell IE to render with the latest engine instead of compatibility mode. ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <? // Disable zooming on mobile devices ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?=isset($page_title) ? $page_title : $CONFIG["default_page_title"] ?></title>

  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/admin.css" rel="stylesheet">
  <link href="/favicon.ico?v=2" rel="icon">
  <? // Javascript is in footer.php ?>
</head>
<body>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?= $CONFIG["admin_header"] ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?= nav_link("Attendees", "/admin/index.php") ?>
        <?= nav_link("Pre Reg Check In", "/admin/pre-reg.php") ?>
        <?= nav_link("At Door Check In", "/admin/at-door.php") ?>
        <?= nav_link("Prices", "/admin/prices.php") ?>
        <?= nav_link("Numbers", "/admin/numbers.php") ?>
        <? if(current_user()->admin){ ?>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Config <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?= nav_link("Overview", "/admin/config/index.php") ?>
              <?= nav_link("Blacklist", "/admin/blacklist.php") ?>
              <?= nav_link("Users", "/admin/config/users.php") ?>
            </ul>
          </li>
        <? } ?>
      </ul>
      <form class="navbar-form navbar-left" role="search" action="/admin/search.php" method="get">
        <div class="form-group">
          <input type="text" class="form-control" name="q" placeholder="Search Attendee" value="<?=@$_GET['q'] ?>">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><?=current_user()->username ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/logout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>