<?php
include("inc/data.php");
include("inc/functions.php");

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  if (isset($catalog[$id])) {
    $item = $catalog[$id];
  }
}

if (!isset($item)) {
  header("location:catalog.php");
  exit;
}

$pageTitle = $item["title"];
$section = null;

include("inc/header.php"); ?>

<div class="section page">
  <div class="wrapper">
    <div class="media-picture">
      <span>
        <img src="<?php echo $item["img"]; ?>" alt="<?php echo $item["title"]; ?>" />
      </span>
    </div>
  </div>
</div>
