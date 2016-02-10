<div ontouchmove="event.scrollable=true" style="overflow-y: auto; height: 100%; padding-right: 10px;">
    <?php
    $story = array_reverse($story);
    ?>
    <div  id="time-anchors" style="opacity: 1; display: none;">
        <?php for($i = 0; $i < count($story); $i++): ?>
            <div class="anchor"><canvas></canvas><div class="year"><?= $story[$i][0]; ?></div><div class="words"><?= $story[$i][1]; ?></div><div class="heart-chart"></div></div>
        <?php endfor; ?>
    </div>
    <div style="opacity: 1;">
        <div id="touch-us"><div><div class="her"></div><div class="me"></div></div></div>
    </div>

    <script>
        (function () {
            var doms = document.querySelectorAll('#time-anchors canvas');
            var len = doms.length;
            for (var i = 0; i < len; i++) {
                new Heart(doms[i]);
            }
        }());
    </script>
</div>