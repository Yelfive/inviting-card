<div ontouchmove="event.scrollable=true" style="overflow-y: auto; height: 100%; padding-right: 10px;">
    <?php
        $story = [
            ['2001', '他们是邻居，却不知道彼此的存在'],
            ['2002', '他们是初中同学，第一次相约一起回家，他沉默寡言，她叽叽喳喳，所以，这成为他们最后一次一起回家'],
            ['2005', '他们分别被两所重点高中录取，彼此没有了联系，他们的妈妈们却不知不觉成为了朋友'],
            ['2008', '他们在不同的城市上大学，暑假某一天，她穿了双黑色的高跟鞋，他说：“好难看。”她：“……”这是她第一次穿高跟鞋'],
            ['2009', '参加初中同学会，他觉得她像小孩子一样，其实特别可爱'],
            ['2013', '他向她表白，被拒，因为尴尬，两人再无联系'],
            ['2014', '父母们安排的一次相亲，对象居然就是彼此，可能这就是缘分'],
            ['2015', '他们领了结婚证，成为了彼此最亲密的人'],
            ['现在', '他们已经相识。。年。。日。。天。。分。。秒，诚挚地邀请您来参加他们的婚礼，共同见证他们的幸福时刻']
        ];
    $story = array_reverse($story);
    ?>
    <div style="opacity: 1; display: none;">
        <div id="time-anchors">
            <?php for($i = 0; $i < count($story); $i++): ?>
                <div><canvas></canvas><div class="year"><?= $story[$i][0]; ?></div><div class="words"><?= $story[$i][1]; ?></div></div>
            <?php endfor; ?>
        </div>
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