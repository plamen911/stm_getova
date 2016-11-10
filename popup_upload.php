<?php
require('includes.php');

$firm_id = (isset($_GET['firm_id']) && is_numeric($_GET['firm_id'])) ? (int)$_GET['firm_id'] : 0;
$firmInfo = $dbInst->getFirmInfo($firm_id);
if (!$firmInfo) {
    die('Липсва индентификатор на фирмата!');
}

$currentUrl = $_SERVER['PHP_SELF'] . '?firm_id=' . $firm_id;

//$uploadDir = __DIR__ . '/docs/' . $firm_id . '/';
$uploadDir = 'docs/' . $firm_id . '/';
make_uploaddir($uploadDir);

if (!empty($_GET['delete']) && file_exists($uploadDir . $_GET['delete'])) {
    @unlink($uploadDir . $_GET['delete']);
    header('Location: ' . $currentUrl);
    exit();
}

if ($_FILES['upfile'] && count($_FILES['upfile']['name'])) {
    for ($i = 0; $i < count($_FILES['upfile']['name']); $i++) {
        if (UPLOAD_ERR_OK === $_FILES['upfile']['error'][$i]) {
            $fname = basename($_FILES['upfile']['name'][$i]);
            $ftmp_name = $_FILES['upfile']['tmp_name'][$i];

            $uploadFile = str_replace(' ', '_', str_replace('-', '_', $fname));
            $uploadFile = preg_replace('/[^A-Za-zА-Яа-я0-9\-_\.]/', '', $uploadFile);
            $uploadFile = preg_replace('/(\..{2,4})$/', '_' . date('Y-m-d-H-i-s') . '$1', $uploadFile);

            if (!move_uploaded_file($ftmp_name, $uploadDir . $uploadFile)) {
                setFlash('Възникна неочакван проблем при добавяне на файл ' . $fname . '.');
                header('Location: ' . $currentUrl);
                exit();
            }
        } elseif (in_array($_FILES['upfile']['error'][$i], array(UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE))) {
            setFlash('Exceeded filesize limit.');
            header('Location: ' . $currentUrl);
            exit();
        }
    }
    header('Location: ' . $currentUrl);
    exit();
}

?><!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="//getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <?php if ('' !== ($msg = getFlash())): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>

    <div class="panel panel-default">
        <!--<div class="panel-heading">Качване на файл</div>-->
        <div class="panel-body">
            <form action="<?php echo $currentUrl; ?>" method="post"
                  enctype="multipart/form-data" class="form-inline">
                <div class="form-group">
                    <label for="upfile" class=" class=" form-control"">Избери файл</label>
                    <input type="file" id="upfile" name="upfile[]" multiple required>
                    <small id="upfileHelp" class="form-text text-muted">Максимален размер на файловете: <?php echo (int)(ini_get('post_max_size')); ?>MB</small>
                </div>
                <input type="submit" value="Качи" class="btn btn-primary" onclick="this.value='Моля, изчакайте...';">
            </form>
        </div>
    </div>

    <?php if ($handle = opendir($uploadDir)) : ?>
        <ul class="list-group">
            <?php while (false !== ($entry = readdir($handle))): ?>
                <?php if ($entry != '.' && $entry != '..'): ?>
                    <li class="list-group-item clearfix">
                        <a href="<?php echo $uploadDir . '/' . $entry; ?>" target="_blank">
                            <span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo $entry; ?>
                        </a>
                        <span class="pull-right">
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?firm_id=<?php echo $firm_id; ?>&amp;delete=<?php echo urlencode($entry); ?>" onclick="return confirm('Сигурни ли сте, че искате да изтриете файла?');" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </span>
                    </li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
        <?php closedir($handle); ?>
    <?php endif; ?>
</div>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="//getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>

