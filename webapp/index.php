<!-- v0.1 beta @ 2014/05/18 04:02 WIB -->
<?php 
// MINIFY HTML
function sanitize_output($buffer)
{
    $search = array(
        '/ {2,}/',
        '/<!--.*?-->|\t|(?:\r?\n[ \t]*)+/s'
    );
    $replace = array(
        ' ',
        ''
    );
  $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}
ob_start("sanitize_output");

function getRealIpAddr()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))
  //check ip from share internet
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  //to check ip is pass from proxy
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
$getip = getRealIpAddr();
$ipmu = explode(",", $getip);
$prefix = implode(".", array_slice(explode(".", $ipmu[0]), 0, 3));

?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ZynOS-based ADSL Modem Password Recovery">
    <title>Lihat IP Tetangga [beta]</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/cosmo/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="/favicon.png" rel="shortcut icon" />
    <link href="css/jumbotron-narrow.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="header">
        <h3>Lihat IP Tetangga [beta]</h3>
      </div>
      
      <div class="panel panel-primary">
        <div id="toggler" class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-question-circle"></i>&nbsp; Apa gunanya..?</h3>
        </div>
        <div id="toggled" class="panel-body">
          <p>
            WebApp ini berfungsi untuk memeriksa dan menampilkan rentang IP publik tetangga Anda yang sedang online. Misalnya: IP publik Anda sekarang adalah <b><?=$ipmu[0]?></b>, maka rentang IP tetangganya adalah <b><?=$prefix.".1"?></b> sampai dengan <b><?=$prefix.".255"?></b>.
          </p>
        </div>
      </div>

      <div id="divgrab" class="jumbotron">
        <p class="lead">
          IP publik Anda:
        </p>
        <p>
          <input id="kissurl" type="text" class="form-control" placeholder="123.456.789.10" value="<?=$ipmu[0]?>" disabled>
        </p>
        <!-- <p class="pull-left nb">
          * Alamat IP yang tertulis di atas adalah alamat IP publik Anda
        </p> -->
        <p>
          <button id="grab" class="btn btn-primary"><i class="fa fa-sitemap"></i>&nbsp;&nbsp; Cek IP Tetangga</button>
        </p>
      </div>
      
      <div id="listPanel" class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-spin fa-gear"></i>&nbsp; Memeriksa IP tetangga..</h3>
        </div>
        <div class="panel-body">
            <div id="listDiv">
            </div>
            <span id="wait"><i class="fa fa-spin fa-spinner"></i>&nbsp; Sedang bekerja, proses tidak akan memakan waktu lebih dari 30 detik :)</span>
        </div>
      </div>

      <div class="alert alert-info">
        <p>
          WebApp ini menentukan sebuah IP online atau tidak online dengan cara mengirimkan paket PING ke IP target. Jika IP target memberi paket balasan/REPLY maka IP tersebut akan dianggap online.
        </p>
        <p>
          Pada kenyataannya, sebuah komputer/modem bisa saja menolak paket PING yang dikirimkan kepadanya, jadi hasil yang ditampilkan WebApp ini tidaklah 100% akurat. Apabila Anda memerlukan metode pemeriksaan lain seperti memeriksa port yang terbuka, silahkan mencoba aplikasi scanner dan semacamnya :)
        </p>
      </div>

      <div class="footer">
        <p>( made by @gojigeje ~ v0.1-beta )</p>
      </div>

    </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="js/checker.js" type="text/javascript" charset="utf-8" async defer></script>
  </body>
</html>
