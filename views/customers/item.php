<div class="item">
    <div class="firstName">
        <?= $item->firstName ?>
    </div>
    <div class="lastName">
        <?= $item->lastName ?>
    </div>
    <div class="email">
        <?= $item->email ?>
    </div>
    <div class="address">
        <?= $item->address ?>
    </div>
    <div class="city">
        <?= $item->city ?>
    </div>
    <div class="zipcode">
        <?= $item->zipcode ?>
    </div>

    <a href="/customers/edit/<?= $item->id ?>"class="edit">Edit</a>
</div>