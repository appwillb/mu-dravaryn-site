<?php
//status info char
///////////////////////////////////////////////////
if 	($ctlco == 0) { $ctlc = "Normal"; 	}
elseif 	($ctlco == 1) { $ctlc = "Bloqueado"; 	}
elseif 	($ctlco == 32){ $ctlc = "GM";		}
else 		      { $ctlc = "Normal"; 	}

//status editar char painel adm
///////////////////////////////////////////////////

if     ($niv==5) { $nivel_gm = "ADM"; 	}
elseif ($niv==4) { $nivel_gm = "SADM"; 	}
elseif ($niv==3) { $nivel_gm = "GM"; 	}
elseif ($niv==2) { $nivel_gm = "SGM"; 	}
elseif ($niv==1) { $nivel_gm = "AJ"; 	}
else {		   $nivel_gm = "Comum"; }

if     ($niv==5) { $nivel_gm2 = "Administrador"; 	}
elseif ($niv==4) { $nivel_gm2 = "Sub-Administrador"; 	}
elseif ($niv==3) { $nivel_gm2 = "Game Master"; 		}
elseif ($niv==2) { $nivel_gm2 = "Sub-Game Master"; 	}
elseif ($niv==1) { $nivel_gm2 = "Ajudante"; 		}
else {		   $nivel_gm2 = "Comum"; 		}

?>