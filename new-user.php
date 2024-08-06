<div class="fullModal modal fade" id="newUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="newUserLabel">Novo usuário</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="index.php" method="post">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Digite o usuário" maxlength="10" size="10">
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do usuário</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do usuário" maxlength="30" size="30">
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de usuário</label>
                    <select id="tipo" name="tipo" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="editor" selected>Editor</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="senha1" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha1" name="senha1" placeholder="Digite a senha" maxlength="10" size="10">
                </div>
                <div class="mb-3">
                    <label for="senha2" class="form-label">Confirme a Senha</label>
                    <input type="password" class="form-control" id="senha2" name="senha2" placeholder="Digite a senha novamente" maxlength="10" size="10">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </div>
        </form>
    </div>
</div>