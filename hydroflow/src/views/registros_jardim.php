<main class="main">
    <?php
    renderTitle(
        "Jardins",
        "Gerencie ou adicione novos jardins e suas zonas",
        "potted-plant"
    );
    
    include (TEMPLATE_PATH . "/messages.php")
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
                    <button class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></button>
                </div>
                <div class="table-cell header">
                    Nome
                    <button class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></button>
                </div>
                <div class="table-cell header">
                    Endereço
                    <button class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></button>
                </div>
                <div class="table-cell header">
                    CEP
                    <button class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></button>
                </div>
                <div class="table-cell header">
                    Tamanho
                    <button class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></button>
                </div>
                <div class="table-cell header">
                    Áreas
                    <button class="sort-btn"><i class="ph-bold ph-arrows-down-up"></i></button>
                </div>
            </div>
            <?php foreach($jardins as $jardim) :?>
                <a href="alterar_jardim.php?update=<?= $jardim->id ?>" class="table-row">
                    <div class="table-cell id"><span class="item"><?= str_pad($jardim->id, 4, '0' , STR_PAD_LEFT) ?></span></div>
                    <div class="table-cell"><?= $jardim->nome_jardim ?></div>
                    <div class="table-cell"><?= $jardim->logradouro . " N° " .  $jardim->numero ?></div>
                    <div class="table-cell"><?= $jardim->cep ?></div>
                    <div class="table-cell"><?= $jardim->tamanho?> m²</div>
                    <div class="table-cell">
                        <?php foreach ($zonas as $zona) : ?>
                            <?= $zona->id_jardim == $jardim->id ? "<span class='item'>{$zona->nome_zona}</span>" : "" ?>
                        <?php endforeach ?>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
        <a href="cadastro_jardim.php" class="btn-new"><i class="icon ph-bold ph-plus-circle"></i>Novo</a>
    </div>
</main>