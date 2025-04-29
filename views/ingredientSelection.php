<!DOCTYPE html>

<html lang="en">
    <?php require_once("head.php"); ?>
    <body>
        <form method="POST" action="<?= htmlspecialchars($_SERVER['HTTP_REFERER'] ?? '') ?>">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#fruit-tab-pane" type="button" role="tab">Fruit</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#veggies-tab-pane" type="button" role="tab">Veggies</button>
                </li>
            </ul>
    
            <div class="tab-content">
                <div class="tab-pane fade show active" id="fruit-tab-pane" role="tabpanel" tabindex="0">
                    <table class="table table-striped">
                        <thead>
                            <th>
                                <input type="checkbox" class="ml-1" name="selectAll">
                            </th>
                            <th class="w-100">Select All</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" name="apples">
                                </td>
                                <td class="w-100">Apples</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="peaches">
                                </td>
                                <td class="w-100">Peaches</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="strawberries">
                                </td>
                                <td class="w-100">Strawberries</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="veggies-tab-pane" role="tabpanel" tabindex="0">
                    <table class="table table-striped">
                        <thead>
                            <th>
                                <input type="checkbox" class="ml-1" style="scale: 2 !important" name="selectAll">
                            </th>
                            <th class="w-100">Select All</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" name="carrots">
                                </td>
                                <td class="w-100">Carrots</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="lettuceHeads">
                                </td>
                                <td class="w-100">Lettuce Heads</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    
            <div class="d-flex justify-content-end">
                <button class="btn btn-secondary mr-1" type="reset">Reset</button>
                <button class="btn btn-primary mr-3" type="submit">Confirm</button>
            </div>
        </form>
    </body>
</html>