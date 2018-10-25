<?php

use Illuminate\Database\Seeder;

class AddonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('addons')->insert([
        'add_en' => 'Halloween Race Tee',
        'add_ms' => 'Kaos Lomba Halloween',
        'add_zh' => '万圣节赛事T恤',
        'addprice' => 49.90,
        'desc_en' => '<p>Spooky time is here again!</p><p>If you\'re looking for a casual, sporty race tee with a fun twist specially for this time of the year, we have the perfect one for you.</p><p>This year\'s halloween race tee is back in black with a simple and classic design for all ages! The cute small pumpkin at the front is the perfect symbol for an awesome Halloween. Inspire everyone (spooky beings included) to run and trick-or-treat around your neighbourhood with the beautiful slogan at the back.</p><p>So, celebrate this special day and get yourself a Halloween Race Tee today!</p>',
        'desc_ms' => '<p>Waktu seram telah tiba!</p><p>Jika anda mencari balapan sporty yang kasual dengan sentuhan yang menyenangkan khususnya untuk saat ini, kami memiliki itu yang sempurna untuk anda.</p><p>Lomba halloween tahun ini kembali hitam dengan desain sederhana dan klasik untuk segala usia! Labu kecil yang lucu di depan adalah simbol sempurna untuk Halloween yang mengagumkan. Menginspirasi semua orang (termasuk makhluk menyeramkan) untuk berlari dan trick-or-treat di sekitar lingkungan anda dengan slogan yang indah di belakang.</p><p>Jadi, rayakan hari istimewa ini dan dapatkan diri anda hari Kaos Lomba Haloween hari ini!</p>',
        'desc_zh' => '<p>这是一年中欢乐搞怪的时刻！庆祝万圣节这个特殊的日子，帮自己购买一件万圣节赛赛T恤！</p><p>今年的万圣节比赛T恤采用黑色设计，适合所有年龄段的简约经典款式！衣服正面胸口左侧有一个小南瓜，最能呈现万圣节的元素，衣服背面的标语是我们希望激励您可以持续继续跑下去！</p><p>为自己赢取万圣节赛事T恤，庆祝这个特别的日子！</p>',
        'type' => 'XS,S,M,L,XL',
        'races_id' => 3,
      ]);

      DB::table('addons')->insert([
        'add_en' => 'Very Miss Rabbit Race Tee',
        'add_ms' => 'Tee Lomba Very Miss Rabbit',
        'add_zh' => '好想兔线上跑 T-Shirt',
        'addprice' => 49.90,
        'desc_en' => '<p>The bold, bright pink colour best represents compassion, care and love. By wearing this race tee, we want you to love and care about yourself - living healthily inside and out - to become a better version of ourselves. </p><p>The race tee has a classic design with the Very Miss Rabbit graphic at the front and the back of the tee. The background of the Very Miss Bunny makes him the perfect representation of a great balance of happiness and health - we hope it will inspire you to live healthy, run and achieve your fitness goals! "Time to run, everybunny?!" Join in the race with Very Miss Rabbit today.</p>',
        'desc_ms' => '<p>Warna merah muda yang berani dan terang terbaik mewakili welas asih, perhatian dan cinta. Dengan mengenakan tee lomba ini, kami ingin anda mencintai dan peduli pada diri sendiri - hidup sehat di dalam dan di luar - untuk menjadi versi yang lebih baik dari diri kita sendiri.</p><p>Tee lomba ini memiliki desain klasik dengan grafis Very Miss Rabbit di bagian depan dan belakang tee. Latar belakang Very Miss Bunny membuatnya menjadi representasi sempurna dari keseimbangan kebahagiaan dan kesehatan yang luar biasa - kami berharap itu akan menginspirasi anda untuk hidup sehat, berlari dan mencapai tujuan kebugaran anda! "Waktu untuk lari, everybunny?!" Bergabunglah dalam perlombaan dengan Very Miss Rabbit hari ini.</p>',
        'desc_zh' => '<p>大胆明亮的粉色，最能代表热情、关心和爱了。穿上这件T-Shirt，希望你能多爱多在乎自己一点，身心都健康快乐，成为更好的自己。</p><p>T-Shirt采用经典的设计，不论正面或背面，你都能看见好想兔的可爱踪影。它就是象征快乐和健康。各位想兔粉，今天就加入好想兔线上跑，一起跑起来！</p>',
        'type' => 'XS,S,M,L,XL',
        'races_id' => 6,
      ]);

      DB::table('addons')->insert([
        'add_en' => 'Snow Fox Race Tee',
        'add_ms' => 'Tee Larian Virtual Rubah Salju',
        'add_zh' => '雪狐线上跑 T-Shirt',
        'addprice' => 49.90,
        'desc_en' => '<p>This navy blue tee best portrays the confidence and intelligence of our runners. By wearing this tee, we hope that our runners channel the calming effect of the blue colour to power through their running goals.</p><p>The front of the tee features a number of Arctic Animals - namely the Snow Fox, Polar Bear, Arctic Hare and Penguin - riding a sleigh harmoniously against the backdrop of the snowy tundra landscape.</p><p>The reverse-side of the tee includes our slogan "Inspire millions to run" to remind our runners of the mission they are helping us to complete by wearing this tee and finishing their races!</p>',
        'desc_ms' => '<p>Tee biru navy ini paling menggambarkan kepercayaan diri dan kecerdasan para pelari kami. Dengan mengenakan tee ini, kami berharap bahwa para pelari kami menyalurkan efek menenangkan dari warna biru untuk meraih kekuatan melalui tujuan larian mereka.</p><p>Bagian depan tee menampilkan sejumlah Hewan Kutub Utara - yaitu Rubah Salju, Beruang Kutub, Kelinci Kutub dan Pinguin - mengendarai kereta luncur secara harmonis dengan latar belakang lanskap tundra yang bersalju.</p><p>Sisi sebaliknya dari tee ini mencakup slogan kami "Inspire millions to run" untuk mengingatkan pelari kami tentang misi yang mereka bantu kami selesaikan dengan mengenakan tee ini dan menyelesaikan balapan mereka!</p>',
        'desc_zh' => '<p>这件海军蓝的T-Shirt完美展现了跑者的自信和智慧。穿上它，我们希望，跑者能够感受到蓝色所带来的平静，并且用这样的心态，一步一步完成跑步的目标。</p><p>你看，T-Shirt的正面有好多极地动物喔！有雪狐、北极熊、北极兔还有企鹅。它们正乘着雪橇，滑过白雪覆盖的冻原景观。</p><p>T-Shirt的背面，写着我们的标语「让上百万人跑起来」。每当你看见这句话，就会想起，你正在帮助我们达成一个伟大的任务！对，不要怀疑，穿上这件T-Shirt完赛的你，就是这么棒，这么意义重大！</p>',
        'type' => 'XS,S,M,L,XL',
        'races_id' => 7,
      ]);

      DB::table('addons')->insert([
        'add_en' => 'Samurai Race Tee',
        'add_ms' => 'Tee Larian Virtual Samurai',
        'add_zh' => '最强武士赛事T恤',
        'addprice' => 49.90,
        'desc_en' => '<p>The black colour of the tee depicts the power of the stealthy samurai. We hope that our runners will channel the strength of the samurai through this tee, and to persevere through the challenges they might face when achieving their running goals.</p><p>The illustration on the front is two samurais expertly battling the ocean waves against the background of a bright red moon, which parallels the challenges we might face. In order to become victorious,  we must bravely work past the difficulties. </p><p>The back of the tee also features a picture of a samurai helmet, or kabuto, which is symbolic in samurai culture.</p>',
        'desc_ms' => '<p>Warna hitam dari tee menggambarkan kekuatan samurai yang tersembunyi. Kami berharap pelari kami akan menyalurkan kekuatan samurai melalui tee ini, dan untuk bertahan melalui tantangan yang mungkin mereka hadapi dalam mencapai tujuan mereka.</p><p>Ilustrasi di bagian depan adalah dua samurai yang ahli melawan ombak lautan dengan latar belakang bulan merah terang, yang sejajar dengan tantangan yang mungkin kita hadapi. Untuk menjadi pemenang, kita harus bekerja keras melewati kesulitan.</p><p>Bagian belakang tee juga menampilkan gambar helm samurai, atau kabuto, yang merupakan simbol dalam budaya samurai.</p>',
        'desc_zh' => '<p>T-Shirt采用低调的黑色，象征着武士虽然身手不凡，却不会到处张扬。我们希望所有的跑者，都能够透过这件T-Shirt，得到来自武士的超强力量。有了这股力量，你将能克服所有困难，坚持下去，最后达成你的运动目标。</p><p>T-Shirt的正面，是两位在红色的月亮之下，正在与浪涛搏斗的武士。他们就像是面临挑战的我们，想获胜的话，就得先突破重重难关，但这次我们并不孤单，因为，有超强武士陪着我们啊！</p><p>T-Shirt的背面，有一顶的武士帽，这是所有超强武士都不可或缺的！</p>',
        'type' => 'XS,S,M,L,XL',
        'races_id' => 10,
      ]);

      DB::table('addons')->insert([
        'add_en' => 'Unicorn Race Tee',
        'add_ms' => 'Tee Lomba Unicorn',
        'add_zh' => '独角兽线上跑 T-shirt',
        'addprice' => 49.90,
        'desc_en' => '<p>The Unicorn Race tee is simple and versatile - great for running and casual wear!</p><p>An illustration of a majestic-looking unicorn is located on the left breast pocket of the tee. This emphasizes the mystical and magical properties belonging to the unicorn.</p><p>On the back of the tee, a larger illustration of two unicorns can be seen as they happily trot around on a crescent moon.</p><p>Let’s remember to ‘chase the unicorn’ and strive for excellence while wearing this tee!</p>',
        'desc_ms' => '<p>Tee Lomba Unicorn adalah sederhana dan serbaguna - cocok untuk berlari dan untuk pakaian santai!</p><p>Sebuah ilustrasi unicorn yang tampak megah terletak di saku dada sebelah kiri tee. Ini menekankan sifat mistis dan magis milik unicorn.</p><p>Di bagian belakang tee, ilustrasi dua unicorn yang lebih besar dapat dilihat ketika mereka dengan senang hati berlari mengelilingi bulan sabit.</p><p>Mari ingat untuk "mengejar kuda bertanduk" dan berusaha mencapai keunggulan saat mengenakan tee ini!</p>',
        'desc_zh' => '<p>这件独角兽赛事T-shirt非常简约又用途多多，是你跑步和休闲穿搭的最佳选择！</p><p>T-shirt左胸口的口袋上，你可以看见一只非常美丽精致的独角兽，这象征着独角兽神秘又充满魔幻色彩的特质。</p><p>T-shirt的背面，则画有两只比较大的独角兽，你看，它们正绕着一弯新月，开心地奔驰着～</p><p>T-shirt的背面，则画有两只比较大的独角兽，你看，它们正绕着一弯新月，开心地奔驰着～</p>',
        'type' => 'XS,S,M,L,XL',
        'races_id' => 13,
      ]);
    }
}
