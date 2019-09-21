
<form action="" enctype="multipart/form-data" method="POST" name="nmail_smtp_form">

    <table class="form-table">
    <tbody>
        <tr>
        <th scope="row">
            <label for="nmail_from">E-mail</label>
        </th>
        <td>
            <input name="nmail_from" type="text" class="regular-text" value="<?php echo $this->nmailOptions["from"]; ?>">
        </td>
        </tr>

        <tr>
        <th scope="row">
            <label for="nmail_fromname">Nome E-mail</label>
        </th>
        <td>
            <input name="nmail_fromname" type="text" class="regular-text" value="<?php echo $this->nmailOptions["fromname"]; ?>">
        </td>
        </tr>

        <tr>
        <th scope="row">
            <label for="nmail_host">Host SMPT</label>
        </th>
        <td>
            <input name="nmail_host" type="text" class="regular-text" value="<?php echo $this->nmailOptions["host"]; ?>">

            <label for="nmail_port">Porta</label>
            <input name="nmail_port" type="text" class="small-text" value="<?php echo $this->nmailOptions["port"]; ?>">
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">
            Segurança
        </th>
        <td>
            <label>
                <input name="nmail_smtpsecure" type="radio"
                        value=""<?php if ($this->nmailOptions["smtpsecure"] == '') { ?> checked="checked"<?php } ?> />
                None
            </label>
            
            <label>
                <input name="nmail_smtpsecure" type="radio"
                        value="ssl"<?php if ($this->nmailOptions["smtpsecure"] == 'ssl') { ?> checked="checked"<?php } ?> />
                SSL
            </label>
            
            <label>
                <input name="nmail_smtpsecure" type="radio"
                        value="tls"<?php if ($this->nmailOptions["smtpsecure"] == 'tls') { ?> checked="checked"<?php } ?> />
                TLS
            </label>
        </td>
        </tr>

        <tr valign="top">
        <th scope="row">
            Autenticação
        </th>
        <td>
            <label>
                <input name="nmail_smtpauth" type="radio"
                        value="no"<?php if ($this->nmailOptions["smtpauth"] == 'no') { ?> checked="checked"<?php } ?> />
                No
            </label>
            
            <label>
                <input name="nmail_smtpauth" type="radio"
                        value="yes"<?php if ($this->nmailOptions["smtpauth"] == 'yes') { ?> checked="checked"<?php } ?> />
                Yes
            </label>
        </td>
        </tr>

        <tr>
        <th scope="row">
            <label for="nmail_username">Usuário</label>
        </th>
        <td>
            <input name="nmail_username" type="text" class="regular-text" value="<?php echo $this->nmailOptions["username"]; ?>">
        </td>
        </tr>

        <tr>
        <th scope="row">
            <label for="nmail_password">Senha</label>
        </th>
        <td>
            <input name="nmail_password" type="password" class="regular-text" value="<?php echo $this->nmailOptions["password"]; ?>">
        </td>
        </tr>
    </tbody>
    </table>

    <p class="submit">
    <input type="hidden" name="nmail_smtp_update" value="update"/>
    <input type="submit" name="submit" class="button button-primary" value="Salvar Alterações">
    </p>

</form>