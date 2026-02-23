<?php

namespace App\Enums;

abstract class DocumentEnum
{
    const INDIVIDUAL_SHEET = "Fiche individuelle d’Etat-civil";
    const BIRTH_CERTIFICATE = "Acte de naissance";
    const WORK_CERTIFICATE = "Certificat de travail";
    const MEDICAL_CERTIFICATE = "Certificat Médical médecin traitant";
    const MEDICAL_CERTIFICATE_2 = "Certificat Médical médecin conseil";
    const DEATH_CERTIFICATE = "Certificat de décès";
    const MARRIAGE_CERTIFICATE = "Certificat de mariage";
    const SOCIAL_SECURITY_CARD = "Carte d’assuré social du défunt";
    const POLICE_REPORT = "Rapport de police ou de gendarmerie";
    const GUARDIANSHIP_ORDER = "Ordonnance de tutelle";
    const TREASURY_RECEIPT = "Une quittance du trésor public de 5.000 Frs cfa";
    const RESOURCES_PROOF = "Justificatif des ressources";
    const OLD_PASSPORT = "Ancien passeport";
}