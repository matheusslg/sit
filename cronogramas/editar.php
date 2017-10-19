<?php

// Verificação de Segurança
include '../actions/verificacao.php';

if ($usuario_permitido) {
    $id_post = filter_input(INPUT_POST, 'id_post', FILTER_VALIDATE_INT);
    $titulo_post = filter_input(INPUT_GET, 'postTitulo', FILTER_SANITIZE_STRING);
    $subtitulo_post = filter_input(INPUT_GET, 'postSubtitulo', FILTER_SANITIZE_STRING);
    $delta_post = $_POST['postDelta'];
    
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar Post</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Você pode editar os dados da postagem abaixo.
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form">
                                    <div class="form-group">
                                        <label>Título</label>
                                        <input id="post-titulo" class="form-control" value="<?php echo $titulo_post ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Subtítulo</label>
                                        <input id="post-subtitulo" class="form-control" value="<?php echo $subtitulo_post ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select class="form-control">
                                            <option>Geral</option>
                                        </select>
                                    </div>
                                    <!--<div class="form-group">
                                        <label>File input</label>
                                        <input type="file">
                                    </div>-->
                                    <div id="standalone-container">
                                        <div id="toolbar-container">
                                            <span class="ql-formats">
                                                <select class="ql-font"></select>
                                                <select class="ql-size"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-bold"></button>
                                                <button class="ql-italic"></button>
                                                <button class="ql-underline"></button>
                                                <button class="ql-strike"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <select class="ql-color"></select>
                                                <select class="ql-background"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-script" value="sub"></button>
                                                <button class="ql-script" value="super"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-header" value="1"></button>
                                                <button class="ql-header" value="2"></button>
                                                <button class="ql-blockquote"></button>
                                                <button class="ql-code-block"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-list" value="ordered"></button>
                                                <button class="ql-list" value="bullet"></button>
                                                <button class="ql-indent" value="-1"></button>
                                                <button class="ql-indent" value="+1"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-direction" value="rtl"></button>
                                                <select class="ql-align"></select>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-link"></button>
                                                <button class="ql-image"></button>
                                                <button class="ql-video"></button>
                                                <button class="ql-formula"></button>
                                            </span>
                                            <span class="ql-formats">
                                                <button class="ql-clean"></button>
                                            </span>
                                        </div>
                                        <div id="editor-container"></div>
                                    </div><br />
                                    <!--<div class="form-group">
                                        <label>Multiple Selects</label>
                                        <select multiple class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>-->
                                    <button type="button" class="btn btn-default" onclick="post_editar()">Editar</button>
                                    <button type="reset" class="btn btn-default" onclick="reset_quill()">Apagar</button>
                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    <script>
        ativar_quill();
        quill.setContents(<?php echo $delta_post ?>);
    </script>

    <?php
}

mysqli_free_result($results);

?>
