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
    ['title' => '#1 M.RESETS', 'name' => !empty($row[0]) ? $row[0] : 'testgm2Sum', 'icon' => 'img/charbk.jpg'],
    ['title' => '#1 RESETS',   'name' => !empty($row[2]) ? $row[2] : 'quest3Elf',  'icon' => 'img/charsm.jpg'],
    ['title' => '#1 ASSASSINO','name' => !empty($row[8]) ? $row[8] : 'testgm2Rf',   'icon' => 'img/dl.jpg'],
    ['title' => '#1 GUILDA',   'name' => !empty($row[12]) ? $row[12] : 'Dravaryn',  'icon' => 'img/guild.png'],
    ['title' => 'TOP BLADE M.', 'name' => !empty($row[18]) ? $row[18] : 'test400Dk', 'icon' => 'img/charbk.jpg'],
    ['title' => 'TOP GRAND M.', 'name' => !empty($row[16]) ? $row[16] : 'quest3Dw',  'icon' => 'img/charsm.jpg'],
    ['title' => 'TOP HIGH ELF', 'name' => !empty($row[20]) ? $row[20] : 'testgmElf', 'icon' => 'img/charelf.jpg'],
    ['title' => 'TOP LORD E.',  'name' => !empty($row[24]) ? $row[24] : 'test400Dl', 'icon' => 'img/dl.jpg'],
];
?>
<style>
.luxury-hof-wrapper {
  margin-bottom: 35px;
}
.hof-pedestal-grid {
  display: grid;
  grid-template-columns: repeat(8, 1fr);
  gap: 12px;
}
@media (max-width: 991px) {
  .hof-pedestal-grid { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 600px) {
  .hof-pedestal-grid { grid-template-columns: repeat(2, 1fr); }
}

.hof-pedestal-card {
  background: rgba(14, 20, 32, 0.85);
  border: 1px solid rgba(212, 175, 55, 0.28);
  border-radius: 14px;
  padding: 16px 8px;
  text-align: center;
  transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
  position: relative;
  overflow: hidden;
}
.hof-pedestal-card:hover {
  background: rgba(18, 26, 42, 0.98);
  border-color: #d4af37;
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.85), 0 0 15px rgba(212, 175, 55, 0.35);
}
.hof-rank-tag {
  font-family: 'Rajdhani', sans-serif;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.5px;
  color: #d4af37;
  margin-bottom: 8px;
}
.hof-avatar-circle {
  width: 64px;
  height: 64px;
  margin: 0 auto 10px auto;
  border-radius: 50%;
  border: 2px solid #d4af37;
  box-shadow: 0 0 12px rgba(212, 175, 55, 0.4);
  overflow: hidden;
}
.hof-avatar-circle img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.hof-char-name {
  font-family: 'Montserrat', sans-serif;
  font-size: 12px;
  font-weight: 700;
  color: #fff;
  margin: 0;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>

<div class="luxury-hof-wrapper">
  <div class="section-gold-header">
    <h3><i class="fa fa-star text-gold"></i> HALL DA GLÓRIA • <span>TOP JOGADORES</span></h3>
  </div>

  <div class="hof-pedestal-grid">
    <?php foreach ($top_cards as $c): ?>
    <div class="hof-pedestal-card">
      <div class="hof-rank-tag"><?=$c['title'];?></div>
      <div class="hof-avatar-circle">
        <img src="<?=$c['icon'];?>" alt="<?=$c['name'];?>">
      </div>
      <h5 class="hof-char-name"><?=$c['name'];?></h5>
    </div>
    <?php endforeach; ?>
  </div>
</div>
