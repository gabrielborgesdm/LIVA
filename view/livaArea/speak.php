<?php include '../head.php'?>
<link rel="stylesheet" type="text/css" href="index.css" />
<link rel="stylesheet" type="text/css" href="speak.css" />
</head>
<body>
  <div class="container-fluid ">
    <?php include 'navigationMenu.php'?>
    <div class="row">
        <div class="col-12 mt-sm-2 mt-md-3 justify-content-center d-flex">
            <!--INÍCIO CONTEÚDO-->
            <div id="conteudoInterna"> 
                <!--BOX TEXT-->
                <div id="label"></div> 
                <input type="image" class="btFalar" value="Falar" src="../assets/multimedia/images/speak/btFalar.jpg" id="speak"/>
                <!--BUTTONS-->
                <div id="contentButtons2"> 
                    <!--BOX LEFT-->
                    <div id="boxLeft">
                        <input class="character" type="image" src="../assets/multimedia/images/speak/a1.jpg" alt="Á" title="Á"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/a2.jpg" alt="À" title="À"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/a3.jpg" alt="Â" title="Â"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/a4.jpg" alt="Ã" title="Ã"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/e1.jpg" alt="É" title="É"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/e2.jpg" alt="Ê" title="Ê"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/i1.jpg" alt="Í" title="Í"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/o1.jpg" alt="Ó" title="Ó"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/o2.jpg" alt="Ô" title="Ô"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/a1.jpg" alt="Ú" title="Ú"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/c1.jpg" alt="Ç" title="Ç"/>
                    </div>
                    <!-- FIM BOX LEFT-->
                    <!--BOX CENTER-->
                    <div id="boxCenter">               
                        <input class="character" type="image" src="../assets/multimedia/images/speak/A.jpg" alt="A" title="A"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/B.jpg" alt="B" title="B"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/C.jpg" alt="C" title="C"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/D.jpg" alt="D" title="D"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/E.jpg" alt="E" title="E"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/F.jpg" alt="F" title="F"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/G.jpg" alt="G" title="G"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/H.jpg" alt="H" title="H"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/I.jpg" alt="I" title="I"/>

                        <input class="character" type="image" src="../assets/multimedia/images/speak/J.jpg" alt="J" title="J"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/K.jpg" alt="K" title="K"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/L.jpg" alt="L" title="L"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/M.jpg" alt="M" title="M"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/N.jpg" alt="N" title="N"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/O.jpg" alt="O" title="O"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/P.jpg" alt="P" title="P"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/Q.jpg" alt="Q" title="Q"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/R.jpg" alt="R" title="R"/>

                        <input class="character" type="image" style="margin-left:30px;" src="../assets/multimedia/images/speak/S.jpg" alt="S" title="S"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/T.jpg" alt="T" title="T"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/U.jpg" alt="U" title="U"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/V.jpg" alt="V" title="V"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/W.jpg" alt="W" title="W"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/X.jpg" alt="X" title="X"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/Y.jpg" alt="Y" title="Y"/>
                        <input class="character" type="image" src="../assets/multimedia/images/speak/Z.jpg" alt="Z" title="Z"/> 
                        <input class="character"type="image" value="ESPAÇO" src="../assets/multimedia/images/speak/btEspaco.jpg" alt=" " title="Espaço"/>                                  
                    </div>   
                    <!--FIM BOX CENTER-->
                    <!--BOX RIGHT-->
                    <div id="boxRight">       
                      <input type="image" value="Apagar" src="../assets/multimedia/images/speak/btApagar.jpg" alt="Apagar" title="Apagar" id="erase"/>
                      <input class="character" type="image" style="margin-right:6px;" src="../assets/multimedia/images/speak/ponto.jpg" alt="."/>
                      <input class="character" type="image" style="margin-right:6px;" src="../assets/multimedia/images/speak/virgula.jpg"  alt=","/>
                      <input class="character" type="image" style="margin-right:6px;" src="../assets/multimedia/images/speak/exclamacao.jpg" alt="!"/>
                      <input class="character" type="image" src="../assets/multimedia/images/speak/interrogacao.jpg" alt="?"/>
                      <input class="yesOrNo" type="image" style="margin-right:14px;" src="../assets/multimedia/images/speak/btSim.jpg" alt="Sim"/>
                      <input class="yesOrNo" type="image" src="../assets/multimedia/images/speak/btNao.jpg" alt="Não"/>
                    </div>   
                </div>           
            </div>
        </div>
      </div>
    </div>
    <div class="fixed-bottom mt-5" id="standartCategoryTable">
      <a href="index.php">
        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
        Voltar
      </a>
    </div>
  </div>
  <script src="speak.js" type="module"></script>
<?php include '../foot.php'?>


