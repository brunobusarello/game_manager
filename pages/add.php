<?php function addMosdfsdfdal($tipo){ 
    return "
    <button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#<?php echo $tipo ?>\">
        <span class=\"material-symbols-outlined\">
            add
        </span>
    </button>

    <!-- Modal -->
    <div class=\"fullModal modal fade\" id=\"<?php echo $tipo ?>\" tabindex=\"-1\" aria-labelledby=\"<?php echo $tipo ?>Label\" aria-hidden=\"true\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
        <div class=\"modal-header\">
            <h1 class=\"modal-title fs-5\" id=\"<?php echo $tipo ?>Label\">Filtrar</h1>
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
        </div>
        <label class=\"visually-hidden\" for=\"busca\">Buscar</label>
        <form action=\"index.php\">
            <div class=\"modal-body\">
                    <div class=\"p-1\">
                        <div class=\"input-group mt-2\">
                            <label class=\"input-group-text\" for=\"inputGroupSelect01\">Qual a referência para a busca?</label>
                            <select class=\"form-select\" id=\"inputGroupSelect01\" name=\"l\">
                                <option selected value=\"0\">Todos</option>
                                <option value=\"1\">Nome</option>
                                <option value=\"2\">Produtora</option>
                                <option value=\"3\">Gênero</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Fechar</button>
                <button type=\"submit\" class=\"btn btn-primary\" id=\"addBtn\" name=\"msg\" value=\"1\">Filtrar</button>
            </div>
        </form>
        </div>
    </div>
    </div>";
}?>