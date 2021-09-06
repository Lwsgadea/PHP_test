<?php
namespace App;
class Creneau {

  public $debut;
  public $fin;

  public function __construct(int $debut, int $fin) {
    $this->debut = $debut;
    $this->fin = $fin;
  }
  
  /**
   * Formate le rendu des créneaux
   *
   * @return string
   */
  public function toHTML(): string {
    return "<strong>{$this->debut}h</strong> à <strong>{$this->fin}h</strong>";
  }
  
  /**
   * Gère l'appartenance à un créneau
   *
   * @param  int $heure (ex: 16)
   * @return bool
   */
  public function inclusHeure(int $heure): bool {
    return $heure >= $this->debut && $heure <= $this->fin;
  }
    
  /**
   * Gère l'appartenance à plusieurs créneaux
   *
   * @param  Creneau $creneau (ex: [9, 13])
   * @return bool
   */
  public function intersect(Creneau $creneau): bool {
    return $this->inclusHeure($creneau->debut) ||
           $this->inclusHeure($creneau->fin) ||
           ($this->debut > $creneau->debut && $this->fin < $creneau->fin);
  }
}