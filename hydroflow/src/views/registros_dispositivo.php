<main class="main">
    <?php
    renderTitle(
        "Dispositivos",
        "Gerencie ou adicione novos dispositivos de irrigação",
        "circuitry"
    );

    include(TEMPLATE_PATH . "/messages.php");
    ?>
    <div class="content">
        <form action="" method="get" class="search">
            <select name="" id="" class="search-filter">
                <option value="*">Filtro</option>
                <option value="*">Zona</option>
                <option value="*">Jardim</option>
                <option value="*">Plantas</option>
            </select>
            <input type="text" class="search-input" name="search" id="search" placeholder="Pesquisar">
            <button type="submit" class="btn-search"><i class="icon ph-bold ph-magnifying-glass"></i></button>
        </form>
        <div class="table">
            <div class="table-header">
                <div class="table-cell header id">
                    Código
                    <a href="?filtro=dispositivos.id_dispositivo<?= $_GET['filtro'] == 'dispositivos.id_dispositivo' ? $_GET['ordem'] ? '' : '&ordem=DESC' : '' ?>" class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></a>
                </div>
                <div class="table-cell header">
                    Nome
                    <a href="?filtro=dispositivos.nome_dispositivo<?= $_GET['filtro'] == 'dispositivos.nome_dispositivo' ? $_GET['ordem'] ? '' : '&ordem=DESC' : '' ?>" class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></a>
                </div>
                <div class="table-cell header">
                    Modelo
                    <a href="?filtro=dispositivos.modelo_dispositivo<?= $_GET['filtro'] == 'dispositivos.modelo_dispositivo' ? $_GET['ordem'] ? '' : '&ordem=DESC' : '' ?>" class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></a>
                </div>
                <div class="table-cell header">
                    Tipo
                    <a href="" class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></a>
                </div>
                <div class="table-cell header">
                    Jardim
                    <a href="?filtro=jardins.nome_jardim<?= $_GET['filtro'] == 'jardins.nome_jardim' ? $_GET['ordem'] ? '' : '&ordem=DESC' : '' ?>" class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></a>
                </div>
                <div class="table-cell header">
                    Área
                    <a href="?filtro=zonas.nome_zona<?= $_GET['filtro'] == 'zonas.nome_zona' ? $_GET['ordem'] ? '' : '&ordem=DESC' : '' ?>" class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></a>
                </div>
            </div>
            <?php foreach($dispositivos as $dispositivo) :?>
            <a href="cadastro_dispositivo.php?update=<?= $dispositivo->id_dispositivo ?>" class="table-row">
                <div class="table-cell id"><span class="item"><?= str_pad($dispositivo->id_dispositivo, 4, '0' , STR_PAD_LEFT) ?></span></div>
                <div class="table-cell"><?= $dispositivo->nome_dispositivo ?></div>
                <div class="table-cell"><?= $dispositivo->modelo_dispositivo ?></div>
                <div class="table-cell" aria-label="">
                        <?php foreach($tipo_dispositivos as $tipo_dispositivo) :?>
                            <?= $tipo_dispositivo->id == $dispositivo->id_tipo_dispositivo ? $tipo_dispositivo->nome_tipo_dispositivo : '' ?>
                        <?php endforeach ?>
                    </div>
                <div class="table-cell">
                    <?= $dispositivo->nome_jardim ?>
                </div>
                <div class="table-cell">
                    <span class="item"><?= $dispositivo->nome_zona ?></span>
                </div>
            </a>
            <?php endforeach ?>
        </div>
        <a href="cadastro_dispositivo.php" class="btn-new"><i class="icon ph-bold ph-plus-circle"></i>Novo</a>
    </div>
</main>