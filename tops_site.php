<?php
header('Content-Type: text/html; charset=utf-8');
include("inclu/config_simples.php");

$query = "select 
valor1, valor1_img,
valor2, valor2_img,
valor3, valor3_img,
valor4, valor4_img,
valor5, valor5_img,
valor6, valor6_img,
valor7, valor7_img,
valor8, valor8_img,
valor9, valor9_img,
valor10, valor10_img,
valor11, valor11_img,
valor12, valor12_img,
valor13, valor13_img,
valor14, valor14_img,
valor15, valor15_img,
valor16, valor16_img
from public.fn_tops()";

$result = @mssql_query($query);
$row    = @mssql_fetch_row($result);

$top_cards = [
    ['title' => '#1 M.RESETS', 'name' => !empty($row[0]) ? $row[0] : 'Dravaryn', 'icon' => 'img/charbk.jpg', 'badge' => 'icon-gold'],
    ['title' => '#1 RESETS',   'name' => !empty($row[2]) ? $row[2] : 'Dravaryn', 'icon' => 'img/charsm.jpg', 'badge' => 'icon-gold'],
    ['title' => '#1 PATENTE',  'name' => !empty($row[4]) ? $row[4] : 'Dravaryn', 'icon' => 'img/charelf.jpg', 'badge' => 'icon-cyan'],
    ['title' => '#1 EVENTOS',  'name' => !empty($row[6]) ? $row[6] : 'Dravaryn', 'icon' => 'img/charmg.jpg', 'badge' => 'icon-yellow'],
    ['title' => '#1 ASSASSINO','name' => !empty($row[8]) ? $row[8] : 'Dravaryn', 'icon' => 'img/dl.jpg', 'badge' => 'icon-red'],
    ['title' => '#1 HERÓI',    'name' => !empty($row[10]) ? $row[10] : 'Dravaryn', 'icon' => 'img/sum.jpg', 'badge' => 'icon-green'],
    ['title' => '#1 DUELO',    'name' => !empty($row[14]) ? $row[14] : 'Dravaryn', 'icon' => 'img/rf.jpg', 'badge' => 'icon-purple'],
    ['title' => '#1 GUILD',    'name' => !empty($row[12]) ? $row[12] : 'Dravaryn', 'icon' => 'img/guild.png', 'badge' => 'icon-gold'],
];
?>
<style>
.hall-of-fame-wrap {
  margin-bottom: 25px;
}
.hof-title-bar {
  text-align: center;
  margin-bottom: 18px;
  position: relative;
}
.hof-title-bar h3 {
  font-family: 'Cinzel', serif;
  font-size: 20px;
  font-weight: 800;
  letter-spacing: 2px;
  color: #fff;
  margin: 0;
  display: inline-block;
  background: rgba(13, 17, 26, 0.95);
  padding: 0 20px;
  position: relative;
  z-index: 2;
}
.hof-title-bar h3 span {
  color: #d4af37;
  text-shadow: 0 0 10px rgba(212, 175, 55, 0.6);
}
.hof-title-bar::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent 0%, rgba(212, 175, 55, 0.4) 50%, transparent 100%);
  z-index: 1;
}

.hof-grid {
  display: grid;
  grid-template-columns: repeat(8, 1fr);
  gap: 10px;
}
@media (max-width: 991px) {
  .hof-grid { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 600px) {
  .hof-grid { grid-template-columns: repeat(2, 1fr); }
}

.hof-card {
  background: rgba(16, 22, 33, 0.85);
  border: 1px solid rgba(212, 175, 55, 0.25);
  border-radius: 12px;
  padding: 14px 8px;
  text-align: center;
  transition: all 0.25s ease;
  cursor: pointer;
}
.hof-card:hover {
  background: rgba(22, 30, 46, 0.95);
  border-color: #d4af37;
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.8), 0 0 12px rgba(212, 175, 55, 0.3);
}

.hof-avatar-wrap {
  position: relative;
  width: 60px;
  height: 60px;
  margin: 0 auto 10px auto;
}
.hof-avatar-img {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #d4af37;
  box-shadow: 0 0 10px rgba(212, 175, 55, 0.4);
}
.hof-badge {
  font-family: 'Rajdhani', sans-serif;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.5px;
  color: #d4af37;
  text-transform: uppercase;
  margin-bottom: 4px;
}
.hof-name {
  font-family: 'Montserrat', sans-serif;
  font-size: 12px;
  font-weight: 700;
  color: #fff;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin: 0;
}
</style>

<div class="hall-of-fame-wrap">
  <div class="hof-title-bar">
    <h3>MELHORES DO <span>SERVIDOR</span></h3>
  </div>

  <div class="hof-grid">
    <?php foreach ($top_cards as $card): ?>
    <div class="hof-card" onclick="document.location.href='info_char_pop.php?name=<?=urlencode($card['name']);?>&painel=ok'">
      <div class="hof-badge"><?=$card['title'];?></div>
      <div class="hof-avatar-wrap">
        <img src="<?=$card['icon'];?>" alt="<?=$card['name'];?>" class="hof-avatar-img">
      </div>
      <h5 class="hof-name"><?=$card['name'];?></h5>
    </div>
    <?php endforeach; ?>
  </div>
</div>
