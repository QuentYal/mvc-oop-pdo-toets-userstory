<?= $data['title'] ?>

<form action="<?= URLROOT; ?>/countries/create" method="post">
    <table>
        <tbody>
            <tr>
                <td>
                  Naam land:   
                </td>
                <td>
                    <input type="text" name="name">
                </td>
            </tr>
            <tr>
                <td>
                    Naam hoofdstad:
                </td>
                <td>
                    <input type="text" name="capitalCity">
                </td>
            </tr>
            <tr>
                <td>
                    Naam continent:
                </td>
                <td>
                    <select name="continent">
                        <option value="">-kies een continent-</option>
                        <option value="Europa">Europa</option>
                        <option value="Azi&euml;">Azi&euml;</option>
                        <option value="Noord-Amerika">Noord-Amerika</option>
                        <option value="Zuid-Amerika">Zuid-Amerika</option>
                        <option value="Oceani&euml;">Oceani&euml;</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Afrika">Afrika</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Aantal inwoners:
                </td>
                <td>
                    <input type="number" name="population">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit" value="Verstuur">
                </td>
            </tr>
        </tbody>
    </table>
</form>