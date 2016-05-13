<div class="superhero_identity">

    <h4>
        Your Superhero Identity is:
    </h4>

        <div>
            <h1 class="id">
                <?= $superhero_identity->name ?>
            </h1>
            <div class="qualities">
                <h4>
                    Qualities:
                </h4>

                <h2>
                    <p><?= $quality_1->name ?></p>
                    <p><?= $quality_2->name ?></p>
                </h2>
            </div>
        </div>
</div>


<style type="text/css">

.superhero_identity{
    text-align: center;
}

.qualities{
    margin-top: 30px;
}

</style>