<?php
 include_once("notificacao/funcaoNotificacao.php");
 include_once("conecta.php");
 $conexao = conectar();

 $id_inscricao = $_GET['verificacao'];
 $tipoUsuario = $_SESSION['usuario'][2];

$sql = "SELECT 
    user_pro.id_inscricao, 
    aluno.nome AS nome_aluno, 
    professor.nome AS nome_professor, 
    pro.nome_projeto, 
    pro.data_finalizacao, 
    pro.id_projeto,
    SUM(CASE WHEN freq.id_frequencia IS NOT NULL THEN en.CH ELSE 0 END) AS total_CH
FROM 
    usuario_projeto user_pro 
INNER JOIN 
    usuario aluno ON aluno.id_usuario = user_pro.fk_usuario_id_usuario 
INNER JOIN 
    projeto pro ON pro.id_projeto = user_pro.fk_projeto_id_projeto 
INNER JOIN 
    usuario professor ON professor.id_usuario = pro.fk_projeto_id_professor 
INNER JOIN 
    encontro en ON en.fk_id_projeto = pro.id_projeto 
LEFT JOIN 
    frequencia freq ON freq.fk_id_encontro = en.id_encontro AND freq.fk_usuario_id_usuario = aluno.id_usuario
WHERE 
    user_pro.id_inscricao = $id_inscricao
GROUP BY 
    user_pro.id_inscricao, 
    aluno.nome, 
    professor.nome, 
    pro.nome_projeto, 
    pro.data_finalizacao, 
    pro.id_projeto";

$resultado = executarSQL($conexao, $sql);

$linhas = mysqli_fetch_assoc($resultado);
$total_CH = $linhas['total_CH'];

?>
<!DOCTYPE html>
<html lang='pt-BR' class=''>

<head>

  <meta charset='UTF-8'>
  <title>Certificado</title>
  <link rel="shortcut icon" type="image/x-icon" href="Style/images/icone.jpg">
    <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">
    <link rel="canonical" href="https://codepen.io/kh3996/pen/pojXrBj">
  

  <style id="INLINE_PEN_STYLESHEET_ID">
    * {
  box-sizing: border-box;
}

@media print{
  .no-print, .no-print *{
    display: none !important;
  } 
  .print-m-0{
    margin: 0 !important;
  }
} 
a{
  text-decoration: none;
  color: #333;
}
.btn{
  padding: 10px 17px; 
  border-radius: 3px; 
  background: #f4b71a; 
  border: none; 
  font-size: 12px; 
  margin: 10px 5px;
}

.toolbar{
  background: #333; 
  width: 100vw; 
  position: fixed; 
  left: 0; 
  top: 0; 
  text-align: center;
}

.cert-container {
  margin:65px 0 10px 0; 
  width: 100%; 
  display: flex; 
  justify-content: center;
}

.cert {
  width:800px; 
  height:600px; 
  padding:15px 20px; 
  text-align:center; 
  position: relative; 
  z-index: -1;
}

.cert-bg {
  position: absolute; 
  left: 0px; 
  top: 0; 
  z-index: -1;
  width: 100%;
}

.cert-content {
  width:750px; 
  height:470px; 
  padding:110px 60px 0px 60px; 
  text-align:center;
  font-family: Arial, Helvetica, sans-serif;
  
}

h1 {
  font-size:44px;
}

p {
  font-size:25px;
}

small {
  font-size: 14px;
  line-height: 12px;
}

.bottom-txt {
  padding: 12px 5px; 
  display: flex; 
  justify-content: space-between;
  font-size: 16px;
}

.bottom-txt * {
  white-space: nowrap !important;
}

.other-font {
  font-family: Cambria, Georgia, serif;
  font-style: italic;
}

.ml-215 {
  margin-left: 215px;
}
  </style>

  
</head>

<body>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    
  

   
    <div class="toolbar no-print">
      <button class="btn btn-info" onclick="window.print()">
        Imprimir Certificado
      </button>
      
   



      <button class="btn btn-info" id="downloadPDF">Baixar em PDF</button>
      <?php
      if($tipoUsuario = 1){?>
        <a href="Login/professor/certificadoAluno.php?id_projeto=<?php echo $linhas['id_projeto']?>" class="btn btn-info">Voltar</a>

   <?php   }
   
   if ($tipoUsuario = 2){?>
   <a href="Login/professor/certificadoAluno.php?id_projeto=<?php echo $linhas['id_projeto']?>" class="btn btn-info">Voltar</a>
   <?php }
   ?>
      
    </div>
    <div class="cert-container print-m-0">
      <div id="content2" class="cert">
        <img
          src="./Style/images/fundocertificado.png"
          class="cert-bg"
          alt=""
        />
        <div class="cert-content">
          <h1 class="other-font">Certificado</h1>
          <span style="font-size: 30px;"><?php echo $linhas['nome_aluno'] ?></span>
          <br /><br />
          <span class="other-font"
            ><i><b>participou do(a)</b></i></span
          >
          <br />
          <span style="font-size: 30px;"><b><?php echo $linhas['nome_projeto'] ?></b></span>
          <br /><br>
    
          <small
            >sob orientação do servidor <b><?php echo $linhas['nome_professor'] ?></b>, completando <b><?php echo $total_CH ?></b> horas de participação efetiva.</small
          ><br /><br />
          <div class="bottom-txt">
            <span><b>ID de Verificação:</b> <?php echo $linhas['id_inscricao'] ?></span>
            
              <span style="font-size: 12px;"><b>Verificar</b><br><img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data=http://localhost/TCC_luiz/certificado.php?validacao=<?php echo $linhas['id_inscricao']; ?>&amp;size=100x100" alt="" title="ProjetoFácil" width="80" height="80" /></span>
            
            <span><b>Emitido em:</b> 
            
            <?php
// Definir o timezone
date_default_timezone_set('America/Sao_Paulo');

function dataportugues($suadata) {
    $meses = [
        'January' => 'janeiro',
        'February' => 'fevereiro',
        'March' => 'março',
        'April' => 'abril',
        'May' => 'maio',
        'June' => 'junho',
        'July' => 'julho',
        'August' => 'agosto',
        'September' => 'setembro',
        'October' => 'outubro',
        'November' => 'novembro',
        'December' => 'dezembro'
    ];
    $timestamp = strtotime($suadata);
    if (!$timestamp) {
        echo "Data inválida!";
        return;
    }
    ;
    $mesPortugues = $meses[date('F', $timestamp)] ?? 'Mês desconhecido';
    $dia = date('d', $timestamp);
    $ano = date('Y', $timestamp);

    // Exibir a data formatada
    echo "$dia de {$mesPortugues} de $ano";
}
//Exibir a data
dataportugues($linhas['data_finalizacao']); // Troca esse '2025-02-09' pela variável $ que tem a data
?>
            </span>
          </div>
        </div>
      </div>
    </div>

  
<script>
$("#downloadPDF").click(function () {
  // $("#content2").addClass('ml-215'); // JS solution for smaller screen but better to add media queries to tackle the issue
  getScreenshotOfElement(
    $("div#content2").get(0),
    0,
    0,
    $("#content2").width() + 45,  // added 45 because the container's (content2) width is smaller than the image, if it's not added then the content from right side will get cut off
    $("#content2").height() + 30, // same issue as above. if the container width / height is changed (currently they are fixed) then these values might need to be changed as well.
    function (data) {
      var pdf = new jsPDF("l", "pt", [
        $("#content2").width(),
        $("#content2").height(),
      ]);

      pdf.addImage(
        "data:image/png;base64," + data,
        "PNG",
        0,
        0,
        $("#content2").width(),
        $("#content2").height()
      );
      pdf.save("certificado.pdf");
    }
  );
});

// this function is the configuration of the html2cavas library (https://html2canvas.hertzen.com/)
// $("#content2").removeClass('ml-215'); is the only custom line here, the rest comes from the library.
function getScreenshotOfElement(element, posX, posY, width, height, callback) {
  html2canvas(element, {
    onrendered: function (canvas) {
      // $("#content2").removeClass('ml-215');  // uncomment this if resorting to ml-125 to resolve the issue
      var context = canvas.getContext("2d");
      var imageData = context.getImageData(posX, posY, width, height).data;
      var outputCanvas = document.createElement("canvas");
      var outputContext = outputCanvas.getContext("2d");
      outputCanvas.width = width;
      outputCanvas.height = height;

      var idata = outputContext.createImageData(width, height);
      idata.data.set(imageData);
      outputContext.putImageData(idata, 0, 0);
      callback(outputCanvas.toDataURL().replace("data:image/png;base64,", ""));
    },
    width: width,
    height: height,
    useCORS: true,
    taintTest: false,
    allowTaint: false,
  });
}


</script>
</body>

</html>