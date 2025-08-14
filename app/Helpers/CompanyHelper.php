<?php

namespace App\Helpers;

use App\Models\CompanyIdentity;

class CompanyHelper
{
    /**
     * Ottiene l'identità aziendale attiva
     */
    public static function getActiveIdentity()
    {
        return CompanyIdentity::getActiveIdentity();
    }

    /**
     * Ottiene l'identità per una sede specifica
     */
    public static function getBranchIdentity($branchCode)
    {
        return CompanyIdentity::getBranchIdentity($branchCode);
    }

    /**
     * Ottiene il nome dell'azienda
     */
    public static function getCompanyName()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->company_name : config('app.name', 'Azienda');
    }

    /**
     * Ottiene il nome commerciale
     */
    public static function getCommercialName()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->commercial_name : self::getCompanyName();
    }

    /**
     * Ottiene lo slogan
     */
    public static function getSlogan()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->slogan : '';
    }

    /**
     * Ottiene l'email di contatto
     */
    public static function getEmail()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->email : '';
    }

    /**
     * Ottiene il telefono
     */
    public static function getPhone()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->phone : '';
    }

    /**
     * Ottiene il sito web
     */
    public static function getWebsite()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->website : '';
    }

    /**
     * Ottiene l'indirizzo legale
     */
    public static function getLegalAddress()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->legal_address : '';
    }

    /**
     * Ottiene la partita IVA
     */
    public static function getPartitaIva()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->partita_iva : '';
    }

    /**
     * Ottiene il codice fiscale
     */
    public static function getCodiceFiscale()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->codice_fiscale : '';
    }

    /**
     * Ottiene il REA
     */
    public static function getRea()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->rea : '';
    }

    /**
     * Ottiene la PEC
     */
    public static function getPec()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->pec : '';
    }

    /**
     * Ottiene il codice SDI
     */
    public static function getSdi()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->sdi : '';
    }

    /**
     * Ottiene il logo per un tipo specifico
     */
    public static function getLogo($type = 'large')
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->getLogoForDocument($type) : null;
    }

    /**
     * Ottiene i colori dell'azienda
     */
    public static function getColors()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->getCssVariables() : [];
    }

    /**
     * Ottiene il colore primario
     */
    public static function getPrimaryColor()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->primary_color : config('company.defaults.colors.primary');
    }

    /**
     * Ottiene il colore secondario
     */
    public static function getSecondaryColor()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->secondary_color : config('company.defaults.colors.secondary');
    }

    /**
     * Ottiene i font dell'azienda
     */
    public static function getFonts()
    {
        $identity = self::getActiveIdentity();
        return [
            'primary' => $identity ? $identity->primary_font : config('company.defaults.fonts.primary'),
            'secondary' => $identity ? $identity->secondary_font : config('company.defaults.fonts.secondary'),
        ];
    }

    /**
     * Ottiene i social media
     */
    public static function getSocialMedia()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->social_media : [];
    }

    /**
     * Ottiene i canali di contatto
     */
    public static function getContactChannels()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->contact_channels : [];
    }

    /**
     * Ottiene la mission
     */
    public static function getMission()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->mission : '';
    }

    /**
     * Ottiene la vision
     */
    public static function getVision()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->vision : '';
    }

    /**
     * Ottiene i valori
     */
    public static function getValues()
    {
        $identity = self::getActiveIdentity();
        return $identity ? $identity->values : [];
    }

    /**
     * Verifica se esiste un'identità aziendale
     */
    public static function hasIdentity()
    {
        return CompanyIdentity::count() > 0;
    }

    /**
     * Ottiene tutte le identità aziendali
     */
    public static function getAllIdentities()
    {
        return CompanyIdentity::orderBy('company_name')->get();
    }
}
