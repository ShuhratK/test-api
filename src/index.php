<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/src/dbconnection.php');
session_start();

?>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/Views/Templates/header.php'); ?>
<div class="container">
    <?php
    if (isset($_SESSION['id'])) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/api/trophies/" . $_SESSION['id'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    ?>
        <h1> У тебя <?= json_decode($response, true)['count'] ?? "0" ?> Трофеев</h1>
    <?php } else { ?>
        <div class="bg-dark text-secondary px-4 py-5 text-center">
    <div class="py-5">
      <h1 class="display-5 fw-bold text-white">Get your trophies</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4">Log in to know how many trophies YOU 🫵 have 
        </p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <a type="button" href ="/login" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Log in</a>
        </div>
      </div>
    </div>
  </div>
    <?php } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Views/Templates/footer.php'); ?>