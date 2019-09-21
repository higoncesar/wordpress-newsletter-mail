
<form action="" method="post" enctype="multipart/form-data" name="nmail_testform">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                   Teste de E-mail
                </th>
                <td>
                    <label>
                        <input type="email" name="nmail_to" value="" size="43" style="width:272px;height:24px;" required />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Assunto
                </th>
                <td>
                    <label>
                        <input type="text" name="nmail_subject" value="" size="43" style="width:272px;height:24px;" required />
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Mensagem
                </th>
                <td>
                    <label>
                        <textarea type="text" name="nmail_message" value="" cols="45" rows="3"
                                  style="width:284px;height:62px;" required></textarea>
                    </label>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="hidden" name="nmail_test" value="test"/>
            <input type="submit" class="button-primary" value="Enviar Test"/>
        </p>
    </form>