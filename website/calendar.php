<?php

require_once("include/html_functions.php");

if (isset($_GET['date']))
{
   $date = $_GET['date'];
}
else
{
   $date = floor(time()/(24*3600));
}
$cur_text = date("l jS \of F Y", $date*24*3600);
$day = date("D", $date*24*3600);
$is_party = ($day == "Fri" || $day == "Sat");
// add a day
$next_time = $date + 1;
?>

<?php our_header("calendar"); ?>


<div class="column prepend-1 span-24 first last">
  <h2>WackoPicko Calendar</h2>
  <p>
   What is going on <?= $cur_text ?>?
  </p>
  <?php if ($is_party) { ?>
  <p>We're throwing a party!<br />
  Use this coupon code: SUPERYOU21 for 10% off in celebration!
  </p>
  <?php } else { ?>
  <p>Nothing!</p>
  <?php } ?>
  <p>
    <a href="/calendar.php?date=<?= $next_time ?>">What about tomorrow?</a>
  </p>
</div>


<?php our_footer(); ?>



