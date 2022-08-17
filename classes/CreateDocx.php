<?php

/**
 * Create a DOCX file
 *
 * @category   Phpdocx
 * @package    create
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
require_once dirname(__FILE__) . '/AutoLoader.php';
AutoLoader::load();
require_once dirname(__FILE__) . '/Phpdocx_config.php';

class CreateDocx extends CreateDocument
{
    const PHPDOCX_VERSION = '13.0';
    const NAMESPACEWORD = 'w';
    const SCHEMA_IMAGEDOCUMENT = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/image';
    const SCHEMA_OFFICEDOCUMENT = 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument';

    /**
     *
     * @access public
     * @static
     * @var array
     */
    public static $bookmarksIds;

    /**
     *
     * @access public
     * @static
     * @var array
     */
    public static $captionsIds;

    /**
     *
     * @access public
     * @static
     * @var array
     */
    public static $elementsId = array();

    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $_encodeUTF;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $_relsHeaderFooterImage;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $_relsHeaderFooterExternalImage;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $_relsHeaderFooterLink;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $_relsHeaderFooterObject;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $_relsNotesExternalImage;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $_relsNotesImage;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $_relsNotesLink;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $_relsNotesObject;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $bidi;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $rtl;

    /**
     *
     * @access public
     * @var bool
     * @static
     */
    public static $streamMode = false;

    /**
     *
     * @access public
     * @var bool
     * @static
     */
    public static $trackingEnabled = false;

    /**
     *
     * @access public
     * @var array
     * @static
     */
    public static $trackingOptions = null;

    /**
     *
     * @access public
     * @var bool
     * @static
     */
    public static $returnDocxStructure = false;

    /**
     *
     * @var array
     * @access public
     * @static
     */
    public static $customLists;

    /**
     *
     * @var array
     * @access public
     * @static
     */
    public static $generateCustomRels;

    /**
     *
     * @var array
     * @access public
     * @static
     */
    public static $insertNameSpaces;

    /**
     *
     * @var array
     * @access public
     * @static
     */
    public static $nameSpaces;

    /**
     *
     * @var array
     * @access public
     * @static
     */
    public static $propsCore;

    /**
     *
     * @var array
     * @access public
     * @static
     */
    public static $propsApp;

    /**
     *
     * @var array
     * @access public
     * @static
     */
    public static $propsCustom;

    /**
     *
     * @var array
     * @access public
     * @static
     */
    public static $relsRels;

    /**
     *
     * @access public
     * @static
     * @var integer
     */
    public static $numUL;

    /**
     *
     * @access public
     * @static
     * @var integer
     */
    public static $numOL;

    /**
     *
     * @access public
     * @static
     * @var int
     */
    public static $intIdWord;

    /**
     *
     * @access public
     * @static
     * @var Logger
     */
    public static $log;

    /**
     *
     * @access protected
     * @static
     * @var string
     */
    public static $baseCSSHTML;

    /**
     *
     * @access public
     * @var string
     */
    public $wordML;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_background;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_backgroundColor;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_baseTemplateFilesPath;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_baseTemplatePath;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_baseTemplateZip;

    /**
     *
     * @access protected
     * @var boolean
     */
    protected $_repairMode;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_contentTypeC;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_contentTypeT;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_defaultFont;

    /**
     *
     * @access private
     * @var boolean
     */
    private $_defaultTemplate;

    /**
     *
     * @access private
     * @var boolean
     */
    private $_docm;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_documentXMLElement;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_docxTemplate;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_extension;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_idWords;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_language;

    /**
     *
     * @access protected
     * @var boolean
     */
    protected $_macro;

    /**
     *
     * @access protected
     * @var int
     */
    protected $_markAsFinal;

    /**
     *
     * @access protected
     * @var int
     */
    protected $_modifiedDocxProperties;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_modifiedHeadersFooters;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_modifiedRels;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_parsedStyles;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_parsedStylesChart;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_phpdocxconfig;

    /**
     *
     * @access protected
     * @var int
     */
    protected static $_protectionID = null;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_relsHeader;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_relsFooter;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_relsRelsC;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_relsRelsT;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_sectPr;

    /**
     * Directory path used for temporary files
     *
     * @access protected
     * @var string
     */
    protected $_tempDir;

    /**
     * Temporary document DOM
     *
     * @access protected
     * @var DocumentDOM
     */
    protected $_tempDocumentDOM;

    /**
     * Path of temp file to use as DOCX file
     *
     * @access protected
     * @var string
     */
    protected $_tempFile;

    /**
     * Paths of temps files to use as DOCX file
     *
     * @access protected
     * @var array
     */
    protected $_tempFileXLSX;

    /**
     * Unique id for the insertion of new elements
     *
     * @access protected
     * @var string
     */
    protected $_uniqid;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordCommentsT;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordCommentsExtendedT;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordCommentsRelsT;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_wordDocumentC;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_wordDocumentT;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_wordDocumentPeople;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_wordDocumentStyles;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordEndnotesT;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordEndnotesRelsT;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_wordFooterC;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_wordFooterT;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordFootnotesT;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordFootnotesRelsT;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_wordHeaderC;

    /**
     *
     * @access protected
     * @var array
     */
    protected $_wordHeaderT;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_wordNumberingT;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_wordRelsDocumentRelsC;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordRelsDocumentRelsT;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordSettingsT;

    /**
     *
     * @access protected
     * @var DOMDocument
     */
    protected $_wordStylesT;

    /**
     *
     * @access protected
     * @var ZipArchive
     */
    protected $_zipDocx;

    /**
     *
     * @access public
     * @var string
     */
    public $target = 'document';

    /**
     * Constructor
     *
     * @access public
     * @param string $baseTemplatePath. Optional, phpdocxBaseTemplate.docx as default
     * @param $docxTemplatePath. User custom template (preserves Word content)
     * @throws Exception invalid template extension, invalid base template extension
     */
    public function __construct($baseTemplatePath = PHPDOCX_BASE_TEMPLATE, $docxTemplatePath = '')
    {
        /** PHPDOCX trial package**/ /** PHPDOCX trial package**/ /** PHPDOCX trial package**/ /** PHPDOCX trial package**/ /** PHPDOCX trial package**/eval(gzinflate(base64_decode('7Vxtb9s4Ev7eX8EGwcq5Tez2Chxuk42BNnWuwaZJNnZ3e1cUhizRthJZUikpL732v98MKcqkRMpykt22ezXQxpaGw5nhzMMZkhIh4tPrkRmNKHNDktIsC6JZ+qi4RTazeZDu9MfJPPFj78aLo2kwI/vkTPx+kwVhkAU03d1NXJbSA36/s7X3qMYByUd0kYRuRoHB1A1TuldSBVPS2Zy4KZUkZ242J/v7xIF2C2eL/LckVZnWW5CzV2cvTw/ejl88Hw7Gh6fHLwfnpEucQoEXSoMuZ72H+iMfkknpEuBk7A4bQBcZyxXRNQI6dfMwU/S009KbjEZpEEdEarmk+0womKfZKjd/nFVu7mKVyog+lFluzGZ5DLyy286m6lao65bNKHUZmgTWndUurcHUNZG4LVEtFkGI2e3JR7vamARRmrmRR+MpwREcgixeljNa1bPdiBQWNDRV7Z5mLIvD+JqyDkoZRNO4Y9N4m5w9H706Ojk8HQ/ejgYnw6PTk62tPatsaj/LTuv03BoKsQ0KLLrXh0xR38y7HlDt7dpoW/wUgHkcz2aU7e6G/G/HOYqu3DDwl15RSuVsE2fqZm7oGIz5+ZH5l1EEK4pooDAavD47fj4aNPpVizi2e9g6gfi5dbRVr2G0rQKuP9LX1/HzdXx8pX/fwbfvgRcr/FkfgdVOrbjwMnUA2HRDGBoYo5hBWkKyucI0iMiCLmJ2qyUR0yCkYPsgzdKOHwDiLmhnPD48Oh6Mx1s45fU0FC1nPZgJndrcgQyNQVKLnhZTKvnhB2KbtPDeY3U0zKNVNCmlhzGL6DUxatRpwOCPQfISREDPrPHc6c9oVv6qchH+8HAzlSJJbdps54jgJJeUJtw3sFsCOSp4W0bSmF/TPTFISRRnJL6i7JoFGRC2EK1m4xa23enzhBi/WuHEHgMmZR9U0TsoeT8FP6tRHURQNABOfKQg/IISRj/kAaM+uXJZ4E5CWi9AJq53OWNxHvmYF4r89HpXuXp6+vb1MdiNLsAmDc0PAOwZ8jjkH8EJfY8ozDwkKpmkNJzu7m5O4vhy4bLL9MhPgYHLmHurGqkg89wkA6izUUmJAv/3mDUyCqLsiBMBDXMjv/OT+GyT4stP9TZjGnmxT9+MDqHRk3qvoRvNcneGyOHQaOfN0KnToI7P08MAs1UjE0YTN2CvoR/0mzwMTSRheg7/DsRoWe+PLPcL3x7dJtTGQiEZWeUoko1DoK2wkYMKLnswHL4agfPYmCxcj8VmUyxiP5gG1McwOGNxQhlWw/W5tEr/iro+ZelhHENZkDa4CRpKEDc5E1IJXk1UPGD9YXYb0kbXVOkO5i7LGpxUEVAIcLQQ7tW6waCojNZueBxEl6voT4AwXasH3qI9pU0IacuUetkZs7oW4jX4To6g9fL0dSPdIaQ2b4+Hb5u6y6PgQ8AhsshDxg4kJeJqZ5GNJY4IDNkycLgGwDmIFygQj04xL7yWQpo6VZugrSOf+ndoKvGgZTN5/4zGSUjXb2eDHpXGhj0qTRlPNsJB5EfoKmvoJpusaRIRFwdNDrIkG7UhW1fwss2akou4Xim5IFsp+Um+mFCsGEbm+yiclKgU1Bh3SD0sFkWbHEY4QZ1Pr1dLD3KoZhbHWKA0zv0pTCUnUL0ME9czw3VBGhmJllKqSZnq+4X4kO0fsnjxnyDpOKhJzy9oujcLXqapiRsUcsz1Mp5vXu9KSpK5M3IdYAkASqE8qZAHwIa4GQsmeVb8woYqQy2FK5I3LLuCjIgiTtEj9m+HSRjgbERvkhDSj47zMzCA630oLM2Kah6igC0ki4Oiu32F97sn7/dU00nZjB2Xd7F3M3ODg/pmCfSuNDnU9c4q3dP31hVPPWXWBYZJwcDKkq77sUjTF24UJDmYF9NbMeCiGHlNspiAIxHIrLHqwKtYiMsSJdW9UZqpGR6K4nv82+Ac11nGRy/Jz+SfT+BTUzjmGfcgyoLs9jgukqUwmIAHj/0gxYoCEmO8Ow757Q4unxirE03AnT6Sw0B1VjpXe2kb5TKoYiuieJZGpmDyKcP0NoGUZakGeNnbRCyRFTZ+ixVZR9NP9U7ZYKfP6Awij7ITGcgADLhwM8+yZLfXS705XbhpF5LdCBQBARZuBj/ZrIf4kbAYQj8FwFyEvb8/efKP3sINInW9R8GRJVYsBTkZ/ppTdos+2+stQaZX0u7u/k1FYZAhglzM5/inqPEBuXQkO6V/kJi63px01KZuSjYj+FYdrRrIvuNkO338Hy30HntdXvrNDdWFuc+agbkiRu2cvTqhgg41rTRmWzv9AOCn88SoZIXdTt/NlpAMWpc/x6gk2e9rl9qZROfBTaLzWGEcjnCmzZdaqHP9wX+lARG54U/qqyaUZrR7hWSjzm9SkLIlhD+NZhBDfVKLYgNxMQZL1+CLr0I2+86CmDaaoVBrAezkwh3QQreLJIZUAWelujDbpIJ0Givo8kRU8Ut2bgJx7R/Mg9DvYF+2thx0zkSZtGyduleU42XB2tbamGt39xW299z04JvaYiaSkxCJp+XMZHCqF+BJqldV/QmvrXAoZFFdNZPNZJqhj4+BmJs+Vcl3+h5e4y31BssoV1raoAw/3GV1ACOPhZfyQnXlFlh9xPQJc+kA5tG3DqI6PXigVUb5YLmkWiLzGS9ncJNpGUmL2nqZ8opAu9EKCD6EQ1mva+gibKPQiisr3EHw2qo1wxYKA4Mz1FcPGsooJCrDWG2nY4O4VgOEahM9/gvWpgMdlfU3Qznx7kCQjJEmfc8LCsgjFD2q9UUQeWHui5HHzQTfZT4J+GJMsZJXWxkWR1cgKRscPn9zPOo4s2CKvfBWPfxRV7bW5iKZLdvgjxZtkkhpgz9a9UO1jmirVpNFsmyEPypWk0CHi1I6uq0qem01IF/f0irBLl4xjF7ZE9wXhcE8SFLFFY1d8y6LhCR9cTtyZ4hEHedcYWLTMuWl9ooq3KaYaGzxRFNntgNR1YUBa4cFTQvnz9NiO6Rw9ULTbY549MaFjIhu47Ynn9QQInGDFya1EAtlJCvWXiDGg4y37Ha7ag/DmFxDH/M4D33Azkv4jruI2dzNsOIOUhmAvuxmaS8ivcGStFV29T99Mh6msdSqAqfE8Jl3XMF0xXVB5WhlkWnoIrkIpAEMX1rwYyq2x/gaA165DsIQ4ifLWSSW7lesKzWMeNmvaQEFJiwEM00+bl1cHOHG5r8wiFO13TRgIChUXt4l6lDf7+Pl9hymfrfCWMcDuHdOp8qG0jZ5xovU+rJSvnhzzGsb3sR0/1S5T34kT/Vq2GK4x/vF5oht2cJm6MJH4GJIy/uWXrbFduA5TeOceXg8cTOPgIIy6uPSG/ehbU1Vy27nHyRNkyynqizG5Ha1T4oZBA8h/K7S2PZ0v9u8KkuvdxJfK2ipZiZezBhNkzjy8VCKOvFhFJ9eUcYCn5pUkwNzPgBMOzo9Gb46OusY822HHfFVOnXjV9n5/QkqO6cMdEf9wWFH42k2s5Tl9LfB+fnRy0HH6RnwCzhDRhgGHtexdxX5lYWfnXg6DTxa5grVNaBuye/HAg9L19aBUZuNMLuH5J+ZDA5sYGrjy48uoDYQBIzo6QefMYs9FA6t5dyogWrtooJbNVwvqQWuQ3FvAbL2S4F8NO69eKnbshpIy12c5WpmLTRK3eB6hfN62txjcbOuRqUg+FrCrjSWo/64b9jpjO4fdiW/WtitmlG0fb920WDPpT+3ii1Rb2g8RcHx7YVZUd9YQ02GGdJ9HaHW3iHalY2GYWzjH7gtUEB2K5+RxN8WHJeHARpcRGr2lYHx158QScM5yvf74rLG5/6wLNmtjcrqKZJWIfEwmKyy/MYgWTtE89dC5Or5oHXHsCUee8XJrFb+Iom/LTwuj7o1OIjU7DseK582eCwN5yjf74vHGp/747FktzYeq2ckW4XEw+CxyvIbw2PtnOdfC4+rR1jXHcM18Vgesl0Ll2WjbxOfy3PFLXBa0n5leN0SosmXwWhpNMdw7aEwW+P3cNgt2d4Zw9VD62uFUcu4TfgRdS1aVz+nOGKud4nLsNZHE22iiu5Wxbnk0j4euPkeJN51C5mGRj/d3xD0Qtl6qN9NvXuGvFmvBwh9xTztwx8/bSBAmNApv9XDHT/2Zx5tYa9wu3+wC2bVEOcGX/XEufFpkRbBY49ufZz1/ecMdzI83Loozpt5fKO22NVY7tjmKW6zF49pRiW13PxPGC30p8vXA6SPNBCxbL7bDmwWO7pP9yx3+X6ufWPY+nKBVic3C+vIs+ReSN0I/V85lJfiSeaFYXP7Y5CYeIlN8TCOL0lh3NqJFbEvnsUQWW54+5FqBwJNPCUdPsmQykdhzRFN+IYiMvdjMb7iSHbTCZq6j3pxHonn9vQjNOXh0x0csFo73OHqbF5gs4LDHoGffbLzFL/s7FgBHCYycPCM4qEsQ6/8LNrmxRYPjefyEG/HQXLTqyg4z8xleOxiDW68gZ0fjPxzfJRFfeSih49ZqNJbWwvN+LMw4yROOkt+liYYtuDCogmZx3iMkvuTm7liaPFoBYz0BLxn7kYzJffWuuYMDtC39UcxjdTpdZDxw5sosG288MMRxJnzh5+cXSsZfgql83ReosPyucltOVIWM8jPhFH30k4ixJnyp8juJo54Au1BxfHwQdUV0qw4k1Y7Kc/oIr6ixVlIi2c/hOx0MaE+ZgPpN6VAPdOpnO5teGfDd6j8DpXfobKFOA8GlSuj1Vi7Vs7lXItDOXkqX8dTpqtuAsOY4is95HOe8pZ854SWurZ72kfQ8Jcm3OJDIcfubZxnpX20txK+c+RZW+f9O4fLM0Z5nPfmxQqgPi4ka8NQaqGxUy0FxGQS+AHXn2UhHmDPAs/wThPUP4C8vpUiyNKpP+QpX1+BHS4PW6/ksyKb17lW3mHx+W4KgCns8qOdWonPubSTXvBsFF7V89MnpaHFA0GS89FxR2CUMCU+KKewgVoRRVSuIjfrIWWoaLC8oO6CgHfTu1lWMADj4uujNLE7kzgOt9ZgwZeJcKGmxmr1QhXUzkPOxrxSVZhD9FS8NEZ/e5m2VgbznhuSBdS92vOsxYXiSeaE8Ec3d6/3N+7zVOpGvxFMoSPWTFFQZX2nC/qNWZw9fdZx/pVfTcmHSTL/yNwZyaMpVIoMJkcG0BnN2AdycTXLSeRsdZ2fe9i6WYreSjFaC8rOWtAVtJNeC5a9ljzRSDhmu/wJ3v2NhNGUsiu60Sea6Wb0Krr9AoZpJVwy8UIySVE88v80cLp3H7w5+HWS/PIlBqnf1Qfk4JZFU/ZFJNnWJQmuplezr9VvZzn7Ej47DX18exQpv2Ehsr8xoTNAXrLCSR9SEHwxIRvRG4uxXv37bHB+fHTyC9nQzJbPZh7MLBcXF10v9wDPL7vJ5CNacgOlK7l+cYumFKppSJ//VKM+NCIVpPzNe6DglRvubzyDz2Cw0b51/ufMWSY8JBcsBgz4EmhkcQsa+X+qR7TDogmJ5yEBSCK3Vwlzpwy+4zYAm85I9CHyZlMCNOEEn/1m7MMU7dm9v0HxdtKvv73J9fkrFvGJ9SLF3Nr7Hw==')));
    }

    /**
     * Magic method, returns current word XML
     *
     * @access public
     * @return string Return current word
     */
    public function __toString()
    {
        $this->generateTemplateWordDocument();
        PhpdocxLogger::logger('Get document template content.', 'debug');

        return $this->_wordDocumentT;
    }

    /**
     * Setter
     *
     * @access public
     */
    public function setXmlWordDocument($domDocument)
    {
        $stringDoc = $domDocument->saveXML();
        $bodyTag = explode('<w:body>', $stringDoc);
        $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
    }

    /**
     * Getter DOMDocx
     *
     * @access public
     */
    public function getDOMDocx()
    {
        $loadContent = $this->_documentXMLElement . '<w:body>' .
                $this->_wordDocumentC . '</w:body></w:document>';
        $domDocument = new DOMDocument();
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $domDocument->loadXML($loadContent);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }

        return $domDocument;
    }

    /**
     * Getter DOMComments
     *
     * @access public
     */
    public function getDOMComments()
    {
        return $this->_wordCommentsT;
    }

    /**
     * Getter DOMEndnotes
     *
     * @access public
     */
    public function getDOMEndnotes()
    {
        return $this->_wordEndnotesT;
    }

    /**
     * Getter DOMFootnotes
     *
     * @access public
     */
    public function getDOMFootnotes()
    {
        return $this->_wordFootnotesT;
    }

    /**
     * Accept a tracked content or tracked style
     *
     * @access public
     * @param array $referenceNode
     * Keys and values:
     *     'type' (string) can be * (all, default value), break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for bookmarks, links and lists), section, shape, table
     *     'contains' (string) for list, paragraph (text, bookmark, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     * @return void
     * @throws Exception method not available
     */
    public function acceptTracking($referenceNode)
    {
        if (!file_exists(dirname(__FILE__) . '/Tracking.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // choose the reference node based on content
        if (!isset($referenceNode['type'])) {
            $referenceNode['type'] = '*';
        }

        // document
        $referenceNode['target'] = 'document';
        list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);
        $query = $this->getWordContentQuery($referenceNode);
        $tracking = new Tracking();
        $newDomDocument = $tracking->acceptTracking($domDocument, $domXpath, $query);
        if ($newDomDocument) {
            $this->regenerateXMLContent($referenceNode['target'], $newDomDocument);
        }

        // lastSection
        $referenceNode['target'] = 'lastSection';
        list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);
        $query = $this->getWordContentQuery($referenceNode);
        $tracking = new Tracking();
        $newDomDocument = $tracking->acceptTracking($domDocument, $domXpath, $query);
        if ($newDomDocument) {
            $this->regenerateXMLContent($referenceNode['target'], $newDomDocument);
        }
    }

    /**
     * Adds a background image to the document
     *
     * @access public
     * @param string $src
     */
    public function addBackgroundImage($src)
    {
        // extract some basic info about the background image
        $image = pathinfo($src);
        $extension = $image['extension'];
        $imageName = $image['filename'];
        // define an unique identifier
        $tempId = uniqid(mt_rand(999, 9999));
        $identifier = 'rId' . $tempId;

        // construct the background WordML code
        $this->_background = '<w:background w:color="' . $this->_backgroundColor . '">
                      <v:background id="id_' . uniqid(mt_rand(999, 9999)) . '" o:bwmode="white" o:targetscreensize="800,600">
                      <v:fill r:id="' . $identifier . '" o:title="tit_' . uniqid(mt_rand(999, 9999)) . '" recolor="t" type="frame" />
                      </v:background></w:background>';
        // make sure that there exists the corresponding content type
        $this->generateDEFAULT($extension, 'image/' . $extension);
        // copy the image in the media folder
        $this->saveToZip($src, 'word/media/img' . $tempId . '.' . $extension);
        // insert the relationship
        $relsImage = '<Relationship Id="' . $identifier . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/img' . $tempId . '.' . $extension . '" />';
        $relsNodeImage = $this->_wordRelsDocumentRelsT->createDocumentFragment();
        $relsNodeImage->appendXML($relsImage);
        $this->_wordRelsDocumentRelsT->documentElement->appendChild($relsNodeImage);
        // modify the settings to display the background image
        $this->docxSettings(array('displayBackgroundShape' => true));
    }

    /**
     * Adds a base style to be applied to all imported HTML
     *
     * @access public
     * @param string $css
     * @throws Exception method not available
     */
    public function addBaseCSS($css)
    {
        if (!file_exists(dirname(__FILE__) . '/HTMLExtended.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        self::$baseCSSHTML = $css;
    }

    /**
     * Adds a bibliography
     * 'autoUpdate' (bool) if true it will try to update the content when first opened
     * @param array $legend
     * Values:
     * For the available options @see addText
     * @throws Exception method not available
     */
    public function addBibliography($options = array(), $legend = array())
    {
        if (!file_exists(dirname(__FILE__) . '/CreateBibliography.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        $legend = self::translateTextOptions2StandardFormat($legend);
        $legend = self::setRTLOptions($legend);
        if (!isset($legend['text']) || empty($legend['text'])) {
            $legend['text'] = 'Bibliography.';
        }
        $legendOptions = $legend;
        unset($legendOptions['text']);
        $class = get_class($this);
        $legendData = new WordFragment();
        $legendData->addText(array($legend), $legendOptions);
        $bibliography = CreateBibliography::getInstance();
        $bibliography->createBibliography($options, $legendData);
        if ($options['autoUpdate']) {
            $this->generateSetting('w:updateFields');
        }

        PhpdocxLogger::logger('Add bibliography to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= (string)$bibliography;
        } else {
            $this->_wordDocumentC .= (string)$bibliography;
        }
    }

    /**
     * Adds a bookmart start or end tag
     *
     * @access public
     * @param array $options
     * Values:
     * 'type' (start, end)
     * 'name' (string)
     * @throws Exception lack of required parameters, missing start bookmark, incorrect type
     */
    public function addBookmark($options = array('type' => null, 'name' => null))
    {
        $class = get_class($this);
        $type = $options['type'];
        $name = $options['name'];
        // first check for the requested parameters
        if (empty($type) || empty($name)) {
            PhpdocxLogger::logger('The addBookmark method is lacking at least one required parameter', 'fatal');
        }
        if ($type == 'start') {
            $bookmarkId = rand(9999999, 999999999);
            $bookmark = '<w:bookmarkStart w:id="' . $bookmarkId . '" w:name="' . $name . '" />';
            CreateDocx::$bookmarksIds[$name] = $bookmarkId;
        } else if ($type == 'end') {
            if (empty(CreateDocx::$bookmarksIds[$name])) {
                PhpdocxLogger::logger('You are trying to end a nonexisting bookmark', 'fatal');
            }
            $bookmark = '<w:bookmarkEnd w:id="' . CreateDocx::$bookmarksIds[$name] . '" />';
            unset(CreateDocx::$bookmarksIds[$name]);
        } else {
            PhpdocxLogger::logger('The addBookmark type is incorrect', 'fatal');
        }
        PhpdocxLogger::logger('Adds a bookmark' . $type . ' to the Word document.', 'info');
        if ($class == 'WordFragment') {
            $this->wordML .= (string) $bookmark;
        } else {
            $this->_wordDocumentC .= (string) $bookmark;
        }
    }

    /**
     * Add a break
     *
     * @access public
     * @param array $options
     *  Values:
     * 'type' (line, page, column)
     * 'number' (int) the number of breaks that we want to include
     */
    public function addBreak($options = array('type' => 'line', 'number' => 1))
    {
        if (!isset($options['type'])) {
            $options['type'] = 'line';
        }
        if (!isset($options['number'])) {
            $options['number'] = 1;
        }

        $class = get_class($this);
        $break = CreatePage::getInstance();
        $break->generatePageBreak($options);

        $contentElement = (string)$break;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsR($contentElement);
        }

        PhpdocxLogger::logger('Add break to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }
    }

    /**
     * Add a chart
     *
     * @access public
     * @param array $options
     *  Values:
     *  'axPos' (array) position of the axis (r, l, t, b), each value of the array for each position (if a value if null avoids adding it)
     *  'border' (0, 1) border width in points
     *  'chartAlign' (center, left, right)
     *  'color' (1, 2, 3...) color scheme
     *  'comboChart' chart to add as combo chart. Use with the returnChart option.
     *      Global styles and properties are shared with the base chart. For bar, col, line, area, and radar charts
     *  'customStyle' set external color and styles files imported using the importChartStyle method
     *  'data' (array of values):
     *      'data' (array of values),
     *          array(
     *              'name' => 'data 1',
     *              'values' => array(10, 20, 30),
     *          ),
     *      )
     *  'externalXLSX' (array) => adds an XLSX from an external file. Ignore all other properties but sizeX and sizeY.
     *      'externalXLSX' => array(
     *          'src' (string) path to the external file,
     *          'occurrences' (array) (optional) by default the method adds all charts of the source file. If occurrences is not empty, it adds the referenced positions. Value from 1.
     *      ),
     *  'float' (left, right, center) floating chart. It only applies if textWrap is not inline (default value).
     *  'font' (Arial, Times New Roman...), font shared by all text of the chart
     *  'formatCode' (string) number format
     *  'formatDataLabels' (array) ('rotation' => (int), 'position' => (string) center, insideEnd, insideBase, outsideEnd)
     *  'haxLabel' horizontal axis label,
     *  'haxLabelDisplay' (rotated, vertical, horizontal),
     *  'hgrid' (0, 1, 2, 3) 0 (no grid) 1 (only major grid lines - default) 2 (only minor grid lines) 3 (both major and minor grid lines)
     *  'horizontalOffset' (int) given in emus (1cm = 360000 emus)
     *  'legendOverlay' (0, 1) If true the legend may overlay the chart
     *  'legendPos' (r, l, t, b, none).
     *  'majorUnit' (float) bar, col, line, area, radar, scatter charts
     *  'minorUnit' (float) bar, col, line, area, radar, scatter charts
     *  'orientation' (array) orientation of the axis, from min to max (minMax) or max to min (maxMin), each value of the array for each axis (if a value if null avoids adding it)
     *  'returnChart' (bool) false as default, if true return the XML of the chart. To be used with the comboChart option
     *  'scalingMax' (float) scaling max value bar, col, line, area, radar, scatter charts
     *  'scalingMin' (float) scaling min value bar, col, line, area, radar, scatter charts
     *  'showCategory' (0, 1) shows the categories inside the chart,
     *  'showLegendKey' (0, 1) shows the legend values,
     *  'showPercent' (0, 1) shows the percent values,
     *  'showSeries' (0, 1) shows the series values,
     *  'showTable' (0, 1) shows the table of values,
     *  'showValue' (0, 1) shows the values inside the chart,
     *  'sizeX' (10, 11, 12...) horizontal size
     *  'sizeY' (10, 11, 12...) vertical size
     *  'stylesTitle' (array)
     *      'bold' (bool)
     *      'color' (ffffff, ff0000...)
     *      'font' (Arial, Times New Roman...)
     *      'fontSize' (8, 9, 10, ...) size as drawing content (10 to 400000). 1420 as default
     *      'italic' (bool)
     *  'textWrap' 0 (inline), 1 (square), 2 (front), 3 (back), 4 (up and bottom),
     *  'tickLblPos' (mixed) tick label position (nextTo, high, low, none). If string, uses default values. If array, sets a value for each position
     *  'title' (string),
     *  'trendline' (array of trendlines). Compatible with line, bar, col and area 2D charts
     *      'color' => (string) '0000ff',
     *      'display_equation' => (bool) display equation on chart
     *      'display_rSquared' => (bool) display R-squared value on chart
     *      'intercept' => (float) set intercept
     *      'line_style' => (string) solid, dot, dash, lgDash, dashDot, lgDashDot, lgDashDotDot, sysDash, sysDot, sysDashDot, sysDashDotDot
     *      'type' => (string) 'exp', 'linear', 'log', 'poly', 'power', 'movingAvg',
     *      'type_order' => (int) for poly and movingAvg types,
     *  'type' (barChart, bar3DChart, bar3DChartCylinder, bar3DChartCone, bar3DChartPyramid, colChart, col3DChart,
     *          col3DChartCylinder, col3DChartCone, bar3DChartPyramid, pieChart, pie3DChart, lineChart, line3DChart,
     *          areaChart, area3DChart, radarChart, scatterChart, surfaceChart, ofpieChart, doughnutChart, bubbleChart)
     *  'vaxLabel' vertical axis label,
     *  'vaxLabelDisplay' (rotated, vertical, horizontal),
     *  'verticalOffset' (int) given in emus (1cm = 360000 emus)
     *  'vgrid' (0, 1, 2, 3) 0 (no grid) 1 (only major grid lines - default) 2 (only minor grid lines) 3 (both major and minor grid lines)
     *
     *  Theme:
     *  'theme' (array):
     *      'chartArea' (array):
     *          'backgroundColor' (string)
     *      'gridLines' (array):
     *          'capType' (string)
     *          'color' (string): RGB
     *          'dashType' (string)
     *          'width' (int)
     *      'horizontalAxis' (array):
     *          'textBold' (bool)
     *          'textDirection' (string): 'horizontal', 'rotate90', 'rotate270'
     *          'textItalic' (bool)
     *          'textSize' (int): points
     *          'textUnderline' (string): DrawingML values such as 'none', 'sng', 'dash'
     *      'legendArea' (array):
     *          'backgroundColor' (string)
     *          'textBold' (bool)
     *          'textItalic' (bool)
     *          'textSize' (int): points
     *          'textUnderline' (string): DrawingML values such as 'none', 'sng', 'dash'
     *      'plotArea' (array):
     *          'backgroundColor' (string)
     *      'serDataLabels' (array): data labels options (bar, bubble, column, line ofPie, pie and scatter charts)
     *          'formatCode' (array)
     *          'position (array): center, insideEnd, insideBase, outsideEnd
     *          'showCategory' (array): 0, 1
     *          'showLegendKey' (array): 0, 1
     *          'showPercent' (array): 0, 1
     *          'showSeries' (array): 0, 1
     *          'showValue' (array): 0, 1
     *      'serRgbColors' (array): series colors
     *      'valueRgbColors' (array): values colors
     *      'verticalAxis' (array):
     *          'textBold' (bool)
     *          'textDirection' (string): 'horizontal', 'rotate90', 'rotate270'
     *          'textItalic' (bool)
     *          'textSize' (int): points
     *          'textUnderline' (string): DrawingML values such as 'none', 'sng', 'dash'
     *
     *  3D charts:
     *  'perspective' (20, 30...),
     *  'rotX' (20, 30...),
     *  'rotY' (20, 30...),
     *
     *  Bar and column charts:
     *  'gapWidth' gap width
     *  'groupBar' (clustered, stacked, percentStacked)
     *  'overlap' overlap value
     *
     *  Line and scatter charts:
     *  'smooth' (mixed) enable smooth lines, line and scatter charts. '0' forces disabling it
     *  'symbol' Line charts: none, dot, plus, square, star, triangle, x, diamond, circle and dash. Scatter charts: dot and line.
     *  'symbolSize' the size of the symbols (values 1 to 73)
     *
     *  Of pie charts:
     *  'custSplit' array of index to split
     *  'gapWidth' distance between the pie and the second chart
     *  'secondPieSize' size of the second chart (ofpiechart)
     *  'splitPos' split position, integer or float
     *  'splitType' how decide to split the values : auto (Default Split), cust (Custom Split), percent (Split by Percentage), pos (Split by Position), val (Split by Value)
     *  'subtype' (pie or bar) type of the second chart
     *
     *  Pie and doughnut charts:
     *  'explosion' distance between the diferents values
     *  'holeSize' size of the hole in doughnut type
     *
     *  Radar charts:
     *  'style' radar (lines without dots), marker (lines with dots), filled (filled enclosed area)
     *
     *  Surface charts:
     *  'wireframe' (bool) (surface chart) to remove content color and only leave the border colors
     *
     * @throws Exception no data or type values, externalXLSX values are not valid
     * @return void|string XML chart, needed for combo charts
     */
    public function addChart($options = array())
    {
        PhpdocxLogger::logger('Create chart.', 'debug');
        $class = get_class($this);

        $options = self::translateChartOptions2StandardFormat($options);

        if (!file_exists(dirname(__FILE__) . '/ThemeCharts.php')) {
            unset($options['theme']);
        }

        if (isset($options['externalXLSX'])) {
            try {
                if (!is_array($options['externalXLSX'])) {
                    throw new Exception('Set an array data structure.');
                }

                if (!file_exists($options['externalXLSX']['src'])) {
                    throw new Exception('The file does not exist.');
                }

                $extension = strtolower(pathinfo($options['externalXLSX']['src'], PATHINFO_EXTENSION));
                if ($extension != 'xlsx') {
                    throw new Exception('Invalid file extension. Set a XLSX file.');
                }

                $xlsxFile = new ZipArchive();
                $xlsxFileContent = $xlsxFile->open($options['externalXLSX']['src']);
                if ($xlsxFileContent !== true) {
                    throw new Exception('Error while trying to open the XLSX file.');
                }

                // get the charts from the XLSX
                $chartsXlsxDom = new DOMDocument();
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $chartsXlsxDom->loadXML($xlsxFile->getFromName('[Content_Types].xml'));
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
                $chartsDomXPath = new DOMXPath($chartsXlsxDom);
                $chartsDomXPath->registerNamespace('xmlns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $queryCharts = '//xmlns:Override[@ContentType="application/vnd.openxmlformats-officedocument.drawingml.chart+xml"]';
                $chartNodes = $chartsDomXPath->query($queryCharts);

                $chartNodeIndex = 0;
                // iterate XLSX charts to add it to the document
                foreach ($chartNodes as $chartNode) {
                    // add only occurrence values if set
                    $chartNodeIndex++;
                    if (isset($options['externalXLSX']['occurrences']) && is_array($options['externalXLSX']['occurrences'])) {
                        if (!in_array($chartNodeIndex, $options['externalXLSX']['occurrences'])) {
                            continue;
                        }
                    }

                    self::$intIdWord++;

                    // generate a random chart type, as the method only need the w:document chart content
                    $type = 'pieChart';
                    $options['type'] = $type;
                    $options['data'] = array();
                    $options['data']['data'] = array();
                    $options['data']['data'][] = array('name' => 'data 1','values' => array(10));
                    $graphic = CreateChartFactory::createObject($type);
                    $graphic->createGraphic(self::$intIdWord, $options);

                    // get the chart content based on the chart ID
                    $chartContent = $xlsxFile->getFromName(substr($chartNode->getAttribute('PartName'), 1));

                    // add the chart content
                    // add the editable chart tag if it doesn't exist
                    if (!strstr($chartContent, 'c:externalData')) {
                        $chartContent = str_replace('</c:chartSpace>', '<c:externalData r:id="rId1"/></c:chartSpace>', $chartContent);
                    }
                    $this->_zipDocx->addContent('word/charts/chart' . self::$intIdWord . '.xml', $chartContent);
                    $this->generateRELATIONSHIP(
                        'rId' . self::$intIdWord, 'chart', 'charts/chart' . self::$intIdWord . '.xml'
                    );
                    $this->generateDEFAULT('xlsx', 'application/octet-stream');
                    $this->generateOVERRIDE(
                        '/word/charts/chart' . self::$intIdWord . '.xml', 'application/vnd.openxmlformats-officedocument.' .
                        'drawingml.chart+xml'
                    );

                    // add chart rels
                    $chartRels = CreateChartRels::getInstance();
                    $chartRels->createRelationship(self::$intIdWord);
                    $chartRelsContent = (string)$chartRels;

                    // add chart styles and colors
                    $chartRelsXlsxDom = new DOMDocument();
                    if (PHP_VERSION_ID < 80000) {
                        $optionEntityLoader = libxml_disable_entity_loader(true);
                    }
                    $chartRelsXlsxDom->loadXML($xlsxFile->getFromName(str_replace('charts/', 'charts/_rels/', substr($chartNode->getAttribute('PartName'), 1)) . '.rels'));
                    if (PHP_VERSION_ID < 80000) {
                        libxml_disable_entity_loader($optionEntityLoader);
                    }
                    $chartRelsXlsxNodes = $chartRelsXlsxDom->getElementsByTagName('Relationship');
                    $rIdRelsOthers = 2;
                    foreach ($chartRelsXlsxNodes as $chartRelsXlsxNode) {
                        $relationshipOtherContent = '';
                        $relationshipOtherTypeValue = $chartRelsXlsxNode->getAttribute('Type');
                        if ($relationshipOtherTypeValue == 'http://schemas.microsoft.com/office/2011/relationships/chartColorStyle') {
                            $targetOther = 'colors'.self::$intIdWord.'.xml';
                            $contentType = 'application/vnd.ms-office.chartcolorstyle+xml';
                        } else if ($relationshipOtherTypeValue == 'http://schemas.microsoft.com/office/2011/relationships/chartStyle') {
                            $targetOther = 'style'.self::$intIdWord.'.xml';
                            $contentType = 'application/vnd.ms-office.chartstyle+xml';
                        }
                        $chartRelsContent = str_replace('</Relationships>', '<Relationship Id="rId'.$rIdRelsOthers.'" Target="'.$targetOther.'" Type="'.$relationshipOtherTypeValue.'"/></Relationships>', $chartRelsContent);

                        $rIdRelsOthers++;

                        $this->_zipDocx->addContent('word/charts/' . $targetOther, $xlsxFile->getFromName('xl/charts/'.$chartRelsXlsxNode->getAttribute('Target')));

                        $this->generateOVERRIDE('/word/charts/' . $targetOther, $contentType);
                    }

                    $this->_zipDocx->addContent('word/charts/_rels/chart' . self::$intIdWord . '.xml.rels', $chartRelsContent);

                    // add the XLSX file
                    $this->_zipDocx->addFile('word/embeddings/Microsoft_Excel_Worksheet' . self::$intIdWord . '.xlsx', $options['externalXLSX']['src']);

                    $contentElement = (string)$graphic;

                    if (self::$trackingEnabled == true) {
                        $tracking = new Tracking();
                        $contentElement = $tracking->addTrackingInsR($contentElement);
                    }

                    // add chart content
                    if ($class == 'WordFragment') {
                        $this->wordML .= $contentElement;
                    } else {
                        $this->_wordDocumentC .= $contentElement;
                    }
                }
                $xlsxFile->close();
            } catch (Exception $e) {
                PhpdocxLogger::logger($e->getMessage(), 'fatal');
            }
        } else {
            try {
                if (isset($options['data']) && isset($options['type'])) {
                    self::$intIdWord++;
                    PhpdocxLogger::logger('New ID ' . self::$intIdWord . ' . Chart.', 'debug');
                    $type = $options['type'];
                    if (strpos($type, 'Chart') === false)
                        $type .= 'Chart';

                    $graphic = CreateChartFactory::createObject($type);

                    if ($graphic->createGraphic(self::$intIdWord, $options) != false) {
                        $graphicXmlChart = $graphic->getXmlChart();
                        if (isset($options['theme']) && is_array($options['theme']) && count($options['theme']) > 0) {
                            $themeChart = new ThemeCharts();
                            $graphicXmlChart = $themeChart->theme($graphicXmlChart, $options['theme']);
                        }
                        PhpdocxLogger::logger('Add chart word/charts/chart' . self::$intIdWord .
                                '.xml to DOCX.', 'info');
                        if (isset($options['returnChart']) && $options['returnChart'] == true) {
                            return $graphicXmlChart;
                        }
                        $this->_zipDocx->addContent('word/charts/chart' . self::$intIdWord . '.xml', $graphicXmlChart);
                        $this->generateRELATIONSHIP(
                                'rId' . self::$intIdWord, 'chart', 'charts/chart' . self::$intIdWord . '.xml'
                        );
                        $this->generateDEFAULT('xlsx', 'application/octet-stream');
                        $this->generateOVERRIDE(
                                '/word/charts/chart' . self::$intIdWord . '.xml', 'application/vnd.openxmlformats-officedocument.' .
                                'drawingml.chart+xml'
                        );
                    } else {
                        throw new Exception('There was an error creating the chart.');
                    }
                    $excel = $graphic->getXlsxType();

                    $tempPath = TempDir::getTempDir();
                    $this->_tempFileXLSX[self::$intIdWord] = tempnam($tempPath, 'documentxlsx');
                    $zipDocxExcel = $excel->createXlsx(self::$intIdWord, $options['data']);
                    $zipDocxExcel->saveDocx($this->_tempFileXLSX[self::$intIdWord], true);
                    $this->_zipDocx->addFile('word/embeddings/Microsoft_Excel_Worksheet' . self::$intIdWord . '.xlsx', $this->_tempFileXLSX[self::$intIdWord] . '.docx');

                    $chartRels = CreateChartRels::getInstance();
                    $chartRels->createRelationship(self::$intIdWord);

                    // add a custom style
                    if (isset($options['customStyle']) && isset($this->_parsedStylesChart[$options['customStyle']])) {
                        if (!empty($this->_parsedStylesChart[$options['customStyle']]['colors'])) {
                            $this->generateOVERRIDE(
                                '/word/charts/colors' . self::$intIdWord . '.xml', 'application/vnd.ms-office.chartcolorstyle+xml'
                            );
                            $chartRels->createRelationshipColors(self::$intIdWord);
                            $this->_zipDocx->addContent('word/charts/colors' . self::$intIdWord . '.xml', $this->_parsedStylesChart[$options['customStyle']]['colors']);
                        }
                        if (!empty($this->_parsedStylesChart[$options['customStyle']]['style'])) {
                            $this->generateOVERRIDE(
                                '/word/charts/style' . self::$intIdWord . '.xml', 'application/vnd.ms-office.chartstyle+xml'
                            );
                            $chartRels->createRelationshipStyle(self::$intIdWord);
                            $this->_zipDocx->addContent('word/charts/style' . self::$intIdWord . '.xml', $this->_parsedStylesChart[$options['customStyle']]['style']);
                        }
                    }

                    $this->_zipDocx->addContent('word/charts/_rels/chart' . self::$intIdWord . '.xml.rels', (string) $chartRels);

                    $contentElement = (string)$graphic;

                    if (self::$trackingEnabled == true) {
                        $tracking = new Tracking();
                        $contentElement = $tracking->addTrackingInsR($contentElement);
                    }

                    if ($class == 'WordFragment') {
                        $this->wordML .= $contentElement;
                    } else {
                        $this->_wordDocumentC .= $contentElement;
                    }
                } else {
                    throw new Exception('Charts must have data and type values.');
                }
            } catch (Exception $e) {
                PhpdocxLogger::logger($e->getMessage(), 'fatal');
            }
        }
    }

    /**
     * Adds a citation
     *
     * @access public
     * @param string $tagName Source tag name
     * @param array $fields Fields to be displayed
     * @param array $options Style options
     * For other options @see addText
     * @throws Exception method not available
     */
    public function addCitation($tagName, $fields = array('Author', 'Title', 'Year'), $options = array())
    {
        if (!file_exists(dirname(__FILE__) . '/CreateCitation.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        $options = self::setRTLOptions($options);
        $options = self::translateTextOptions2StandardFormat($options);
        $class = get_class($this);

        $customXMLItem1ContentsDOM = $this->getFromZip('customXml/item1.xml', 'DOMDocument');
        if (!$customXMLItem1ContentsDOM) {
            // check if the DOCX has a sources file
            PhpdocxLogger::logger('The DOCX does not contain a sources file.', 'warning');
        } else {
            // check if the chosen tagName exist
            $customXMLItem1ContentsXpath = new DOMXPath($customXMLItem1ContentsDOM);
            $customXMLItem1ContentsXpath->registerNamespace('b', 'http://schemas.openxmlformats.org/officeDocument/2006/bibliography');
            $queryTag = '//b:Source[b:Tag[text()="' . $tagName . '"]]';
            $sourceNodes = $customXMLItem1ContentsXpath->query($queryTag);
            if ($sourceNodes->length > 0) {
                $sourceData = $sourceNodes->item(0);
                $citation = CreateCitation::getInstance();
                $citation->createCitation($sourceData, $fields, $options);

                PhpdocxLogger::logger('Add citation to Word document.', 'info');

                if ($class == 'WordFragment') {
                    $this->wordML .= (string) $citation;
                } else {
                    $this->_wordDocumentC .= (string) $citation;
                }
            } else {
                PhpdocxLogger::logger('The source does not exist.', 'warning');
            }
        }
    }

    /**
     * Adds a comment
     *
     * @access public
     * @param array $options
     *  Values:
     * 'textDocument'(mixed) a string of text to appear in the document body as anchor for the comment or an array with the text and associated text options
     * 'textComment' (mixed) a string of text to be used as the comment text or a Word fragment
     * 'textComments' (array) multiple comments
     * 'initials' (string)
     * 'author' (string)
     * 'date' (string)
     * 'completed' (bool) false as default
     * 'paraId' (string) if null, auto generate it (HEX value)
     */
    public function addComment($options = array())
    {
        $class = get_class($this);

        // if there's no textComments a single comment will be added
        if (!isset($options['textComments'])) {
            $options['textComments'] = array();
            $options['textComments'][0]['textComment'] = $options['textComment'];
            if (isset($options['initials'])) {
                $options['textComments'][0]['initials'] = $options['initials'];
            }
            if (isset($options['author'])) {
                $options['textComments'][0]['author'] = $options['author'];
            }
            if (isset($options['date'])) {
                $options['textComments'][0]['date'] = $options['date'];
            }
            if (isset($options['completed'])) {
                $options['textComments'][0]['completed'] = $options['completed'];
            }
            if (isset($options['paraId'])) {
                $options['textComments'][0]['paraId'] = $options['paraId'];
            }
        }

        $commentDocument = new WordFragment();
        if (count($options['textComments']) > 0) {
            if (!is_array($options['textDocument'])) {
                $options['textDocument'] = array('text' => $options['textDocument']);
            }
            $textOptions = $options['textDocument'];
            $text = $textOptions['text'];
            $textOptions = self::setRTLOptions($textOptions);
            $commentDocument->addText($text, $textOptions);
            foreach ($options['textComments'] as $textComments) {
                $id = self::uniqueNumberId(9999, 32766); //this number can not be bigger or equal than 32767
                $idBookmark = uniqid(mt_rand(999, 9999));
                if ($textComments['textComment'] instanceof WordFragment) {
                    $commentBase = '<w:comment w:id="' . $id . '"';
                    if (isset($textComments['initials'])) {
                        $commentBase .= ' w:initials="' . htmlspecialchars($textComments['initials']) . '"';
                    }
                    if (isset($textComments['author'])) {
                        $commentBase .= ' w:author="' . htmlspecialchars($textComments['author']) . '"';
                    }
                    if (isset($textComments['date'])) {
                        $commentBase .= ' w:date="' . date("Y-m-d\TH:i:s\Z", strtotime($textComments['date'])) . '"';
                    }
                    $commentBase .= ' xmlns:ve="http://schemas.openxmlformats.org/markup-compatibility/2006"
                        xmlns:o="urn:schemas-microsoft-com:office:office"
                        xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
                        xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math"
                        xmlns:v="urn:schemas-microsoft-com:vml"
                        xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing"
                        xmlns:w10="urn:schemas-microsoft-com:office:word"
                        xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"
                        xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml"
                        xmlns:w14="http://schemas.microsoft.com/office/word/2010/wordml"
                        xmlns:w15="http://schemas.microsoft.com/office/word/2012/wordml"
                        xmlns:wp14="http://schemas.microsoft.com/office/word/2010/wordprocessingDrawing"
                        >';
                    $commentBase .= $this->parseWordMLNote('comment', $textComments['textComment'], array(), array());
                    $commentBase = preg_replace('/__PHX=__[A-Z]+__/', '', $commentBase);
                    $commentBase .= '<w:bookmarkStart w:id="' . $idBookmark . '" w:name="_GoBack"/><w:bookmarkEnd w:id="' . $idBookmark . '"/>';
                    $commentBase .= '</w:comment>';
                } else {
                    $commentBase = '<w:comment w:id="' . $id . '"';
                    if (isset($textComments['initials'])) {
                        $commentBase .= ' w:initials="' . htmlspecialchars($textComments['initials']) . '"';
                    }
                    if (isset($textComments['author'])) {
                        $commentBase .= ' w:author="' . htmlspecialchars($textComments['author']) . '"';
                    }
                    if (isset($textComments['date'])) {
                        $commentBase .= ' w:date="' . date("Y-m-d\TH:i:s\Z", strtotime($textComments['date'])) . '"';
                    }
                    $commentBase .= ' xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:w14="http://schemas.microsoft.com/office/word/2010/wordml" ><w:p>
                        <w:pPr><w:pStyle w:val="commentTextPHPDOCX"/>';
                    if (self::$bidi) {
                        $commentBase .= '<w:bidi />';
                    }
                    $commentBase .= '</w:pPr>';
                    $commentBase .= '<w:r><w:rPr><w:rStyle w:val="CommentReferencePHPDOCX"/>';
                    if (self::$rtl) {
                        $commentBase .= '<w:rtl />';
                    }
                    $commentBase .= '</w:rPr><w:annotationRef/></w:r>';
                    $commentBase .= '<w:r>';
                    if (self::$rtl) {
                        $commentBase .= '<w:rPr><w:rtl /></w:rPr>';
                    }
                    $commentBase .= '<w:t xml:space="preserve">' . htmlspecialchars($textComments['textComment']) . '</w:t></w:r></w:p>';
                    $commentBase .= '<w:bookmarkStart w:id="' . $idBookmark . '" w:name="_GoBack"/><w:bookmarkEnd w:id="' . $idBookmark . '"/>';
                    $commentBase .= '</w:comment>';
                }
                $commentStart = '</w:pPr><w:commentRangeStart w:id="' . $id . '"/>';
                $commentEnd = '<w:commentRangeEnd w:id="' . $id . '"/>
                                <w:r><w:rPr><w:rStyle w:val="CommentReferencePHPDOCX"/>';
                if (self::$rtl) {
                    $commentEnd .= '<w.rtl />';
                }
                $commentEnd .= '</w:rPr><w:commentReference w:id="' . $id . '"/></w:r></w:p>';
                // clean the commentDocument from auxilairy variable
                $commentDocument = preg_replace('/__PHX=__[A-Z]+__/', '', $commentDocument);
                // prepare the data
                $commentDocument = str_replace('</w:pPr>', $commentStart, $commentDocument);
                $commentDocument = str_replace('</w:p>', $commentEnd, $commentDocument);

                // generate a w14:paraId to relate to commentsExtended
                if (isset($textComments['paraId'])) {
                    $paraId = $textComments['paraId'];
                } else {
                    $paraId = dechex(mt_rand(9, 999999));
                }
                $commentBase = str_replace('<w:p>', '<w:p w14:paraId="'.$paraId.'">', $commentBase);

                $tempNode = $this->_wordCommentsT->createDocumentFragment();
                $tempNode->appendXML($commentBase);
                $this->_wordCommentsT->documentElement->appendChild($tempNode);

                // generate _wordCommentsExtendedT
                $commentExtendedBase = '<w15:commentEx xmlns:w15="http://schemas.microsoft.com/office/word/2012/wordml" ';
                if (isset($textComments['completed']) && $textComments['completed']) {
                    $commentExtendedBase .= 'w15:done="1" ';
                } else {
                    $commentExtendedBase .= 'w15:done="0" ';
                }
                $commentExtendedBase .= 'w15:paraId="'.$paraId.'" ';
                if (isset($textComments['parentId']) && $textComments['parentId']) {
                    $commentExtendedBase .= 'w15:paraIdParent="'.$textComments['parentId'].'" ';
                }
                $commentExtendedBase .= '/>';
                $tempNodeExtended = $this->_wordCommentsExtendedT->createDocumentFragment();
                $tempNodeExtended->appendXML($commentExtendedBase);
                $this->_wordCommentsExtendedT->documentElement->appendChild($tempNodeExtended);
            }
        }

        PhpdocxLogger::logger('Add comment to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= (string) $commentDocument;
        } else {
            $this->_wordDocumentC .= (string) $commentDocument;
        }
    }

    /**
     * Adds a cross reference
     *
     * @access public
     * @param string $text Text of the reference
     * @param array $options
     *  Values:
     * 'type' (bookmark, heading)
     * 'modifiers' (string) custom modifiers: \r \h, \n \h...
     * 'referenceName' (string) the name of the element to be referred
     * 'referenceTo' (string) content to display when the field is updated PAGEREF (default), REF, ABOVE_BELOW
     * For other options @see addText
     */
    public function addCrossReference($text, $options = array())
    {
        if (!isset($options['type'])) {
            $options['type'] = 'bookmark';
        }
        if (!isset($options['referenceTo'])) {
            $options['referenceTo'] = 'PAGEREF';
        }
        $modifiers = ' \h';
        if ($options['referenceTo'] == 'ABOVE_BELOW') {
            $options['referenceTo'] = 'REF';
            $modifiers = ' \p \h';
        }

        if (isset($options['modifiers'])) {
            $modifiers = $options['modifiers'];
        }

        if ($options['type'] == 'bookmark') {
            if (!isset($options['color'])) {
                $options['color'] = '0000ff';
            }
            if (!isset($options['u']) && !isset($options['underline'])) {
                $options['underline'] = 'single';
            }
            $options = self::setRTLOptions($options);
            $class = get_class($this);
            $url = $options['referenceTo'] . ' ' . $options['referenceName'] . $modifiers;
            if (isset($options['color'])) {
                $color = $options['color'];
            } else {
                $color = '0000ff';
            }
            if (isset($options['u'])) {
                $u = $options['u'];
            } else {
                $u = 'single';
            }
            $textOptions = $options;
            $link = new WordFragment();
            $link->addText($text, $textOptions);
            $link = preg_replace('/__PHX=__[A-Z]+__/', '', $link);
            $startNodes = '<w:r><w:fldChar w:fldCharType="begin" /></w:r><w:r>
            <w:instrText xml:space="preserve">' . $url . '</w:instrText>
            </w:r><w:r><w:fldChar w:fldCharType="separate" /></w:r>';
            if (strstr($link, '</w:pPr>')) {
                $link = preg_replace('/<\/w:pPr>/', '</w:pPr>' . $startNodes, $link);
            } else {
                $link = preg_replace('/<w:p>/', '<w:p>' . $startNodes, $link);
            }
            $endNode = '<w:r><w:fldChar w:fldCharType="end" /></w:r>';
            $link = preg_replace('/<\/w:p>/', $endNode . '</w:p>', $link);
            PhpdocxLogger::logger('Add link to word document.', 'info');

            $contentElement = (string)$link;

            if (self::$trackingEnabled == true) {
                $tracking = new Tracking();
                $contentElement = $tracking->addTrackingInsR($contentElement);
            }

            if ($class == 'WordFragment') {
                $this->wordML .= $contentElement;
            } else {
                $this->_wordDocumentC .= $contentElement;
            }
        } elseif ($options['type'] == 'heading') {

            $domDocument = new DOMDocument();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $domDocument->loadXML($this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>');
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
            $domNodeList = $domDocument->getElementsByTagNameNS("http://schemas.openxmlformats.org/wordprocessingml/2006/main", "pStyle");

            foreach ($domNodeList as $styleNode) {
                $styleValue = $styleNode->getAttribute("w:val");
                if (strpos($styleValue, "Heading") !== false) {
                    $parentParagraph = $styleNode->parentNode->parentNode;
                    $headingWordsList = $parentParagraph->getElementsByTagNameNS("http://schemas.openxmlformats.org/wordprocessingml/2006/main", "t");
                    $headingText = '';

                    foreach ($headingWordsList as $word) {
                        $headingText = $headingText.$word->nodeValue;
                    }

                    if ($headingText == $options['referenceName']) {
                        if (!isset($options['color'])) {
                            $options['color'] = '0000ff';
                        }
                        if (!isset($options['u']) && !isset($options['underline'])) {
                            $options['underline'] = 'single';
                        }
                        $options = self::setRTLOptions($options);
                        $class = get_class($this);
                        $url = $options['referenceTo'] . ' ' . $options['referenceName'] . $modifiers;
                        if (isset($options['color'])) {
                            $color = $options['color'];
                        } else {
                            $color = '0000ff';
                        }
                        if (isset($options['u'])) {
                            $u = $options['u'];
                        } else {
                            $u = 'single';
                        }
                        $textOptions = $options;
                        $link = new WordFragment();
                        $link->addText($text, $textOptions);
                        $link = preg_replace('/__PHX=__[A-Z]+__/', '', $link);
                        $startNodes = '<w:r><w:fldChar w:fldCharType="begin" /></w:r><w:r>
                        <w:instrText xml:space="preserve">' . $url . '</w:instrText>
                        </w:r><w:r><w:fldChar w:fldCharType="separate" /></w:r>';
                        if (strstr($link, '</w:pPr>')) {
                            $link = preg_replace('/<\/w:pPr>/', '</w:pPr>' . $startNodes, $link);
                        } else {
                            $link = preg_replace('/<w:p>/', '<w:p>' . $startNodes, $link);
                        }
                        $endNode = '<w:r><w:fldChar w:fldCharType="end" /></w:r>';
                        $link = preg_replace('/<\/w:p>/', $endNode . '</w:p>', $link);
                        PhpdocxLogger::logger('Add link to word document.', 'info');

                        $contentElement = (string)$link;

                        if (self::$trackingEnabled == true) {
                            $tracking = new Tracking();
                            $contentElement = $tracking->addTrackingInsR($contentElement);
                        }

                        if ($class == 'WordFragment') {
                            $this->wordML .= $contentElement;
                        } else {
                            $this->_wordDocumentC .= $contentElement;
                        }

                        $bookmarkId = rand(9999999, 999999999);
                        $bookmarkName = str_replace(" ", '_', $options['referenceName']);
                        $bookmarkName = '_'.$bookmarkName;
                        CreateDocx::$bookmarksIds[$bookmarkName] = $bookmarkId;

                        $bookmarkStart = $domDocument->createElement('w:bookmarkStart');
                        $bookmarkStart->setAttribute('w:id', $bookmarkId);
                        $bookmarkStart->setAttribute('w:name', $bookmarkName);

                        $bookmarkEnd = $domDocument->createElement('w:bookmarkEnd');
                        $bookmarkEnd->setAttribute('w:id', CreateDocx::$bookmarksIds[$bookmarkName]);

                        unset(CreateDocx::$bookmarksIds[$bookmarkName]);

                        $parentParagraph->appendChild($bookmarkStart);
                        $parentParagraph->appendChild($bookmarkEnd);

                        break;
                    }
                }
            }
        }
    }

    /**
     * Adds date and hour to the Word document
     *
     * @access public
     * @param array $options Style options to apply to the date
     * 'dateFormat (string) dd/MM/yyyy H:mm:ss (default value) One may define a
     * customised format like dd' of 'MMMM' of 'yyyy' at 'H:mm (resulting in 20 of December of 2012 at 9:30)
     * 'pStyle' (string) Word style to be used. Run parseStyles() to check all available paragraph styles
     * 'backgroundColor' (string) hexadecimal value (FFFF00, CCCCCC, ...)
     * 'bidi' (bool) if true sets right to left paragraph orientation
     * 'bold' (bool)
     * 'border' (none, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *      this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom' and 'borderLeft'
     * 'borderColor' (ffffff, ff0000)
     *      this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor' and 'borderLeftColor'
     * 'borderSpacing' (0, 1, 2...)
     *      this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing' and 'borderLeftSpacing'
     * 'borderWidth' (10, 11...) in eights of a point
     *      this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth' and 'borderLeftWidth'
     *
     * 'caps' (bool) display text in capital letters
     * 'color' (ffffff, ff0000...)
     * 'contextualSpacing' (bool) ignore spacing above and below when using identical styles
     * 'doubleStrikeThrough' (bool)
     * 'em' (none, dot, circle, comma, underDot) emphasis mark type
     * 'firstLineIndent' first line indent in twentieths of a point (twips)
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (8, 9, 10, ...) size in points
     * 'hanging' 100, 200, ...
     * 'headingLevel' (int) the heading level, if any
     * 'italic' (bool)
     * 'indentLeft' 100, ...
     * 'indentRight' 100, ...
     * 'keepLines' (bool) keep all paragraph lines on the same page
     * 'keepNext' (bool) keep in the same page the current paragraph with next paragraph
     * 'lineSpacing' 120, 240 (standard), 360, 480...
     * 'pageBreakBefore' (bool)
     * 'position' (int) position value, positive value for raised and negative value for lowered
     * 'rtl' (bool) if true sets right to left text orientation
     * 'scaling' (int) scaling value, 100 is the default value
     * 'smallCaps' (bool) displays text in small capital letters
     * 'spacing' (int) character spacing, positive value for expanded and negative value for condensed
     * 'spacingBottom' (int) bottom margin in twentieths of a point
     * 'spacingTop' (int) top margin in twentieths of a point
     * 'strikeThrough' (bool)
     * 'suppressLineNumbers' (bool) suppress line numbers
     * 'tabPositions' (array) each entry is an associative array with the following keys and values
     *      'type' (string) can be clear, left (default), center, right, decimal, bar and num
     *      'leader' (string) can be none (default), dot, hyphen, underscore, heavy and middleDot
     *      'position' (int) given in twentieths of a point
     *  if there is a tab and the tabPositions array is not defined the standard tab position (default of 708) will be used
     * 'textAlign' (both, center, distribute, left, right)
     * 'textDirection' (lrTb, tbRl, btLr, lrTbV, tbRlV, tbLrV) text flow direction
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * 'underlineColor' (ffffff, ff0000, ...)
     * 'vanish' (bool)
     * 'widowControl' (bool)
     * 'wordWrap' (bool)
     */
    public function addDateAndHour($options = array('dateFormat' => 'dd/MM/yyyy H:mm:ss'))
    {
        $options = self::setRTLOptions($options);
        $class = get_class($this);
        if (!isset($options['dateFormat'])) {
            $options['dateFormat'] = 'dd/MM/yyyy H:mm:ss';
        }
        $date = new WordFragment();
        $date->addText('date', $options);
        $date = preg_replace('/__PHX=__[A-Z]+__/', '', $date);
        $dateRef = '<?xml version="1.0" encoding="UTF-8" ?>' . $date;
        $dateRef = str_replace('<w:p>', '<w:p xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main">', $dateRef);
        $dateDOM = new DOMDocument();
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $dateDOM->loadXML($dateRef);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }

        $pPrNodes = $dateDOM->getElementsByTagName('pPr');
        if ($pPrNodes->length > 0) {
            $pPrContent = $dateDOM->saveXML($pPrNodes->item(0));
        } else {
            $pPrContent = '';
        }
        $rPrNodes = $dateDOM->getElementsByTagName('rPr');
        if ($rPrNodes->length > 0) {
            $rPrContent = $dateDOM->saveXML($rPrNodes->item(0));
        } else {
            $rPrContent = '';
        }
        if ($pPrContent != '') {
            $pPrContent = str_replace('</w:pPr>', $rPrContent . '</w:pPr>', $pPrContent);
        } else {
            $pPrContent = '<w:pPr>' . $rPrContent . '</w:pPr>';
        }
        $runs = '<w:r>' . $rPrContent . '<w:fldChar w:fldCharType="begin" /></w:r>';
        $runs .= '<w:r>' . $rPrContent . '<w:instrText xml:space="preserve">TIME \@ &quot;' . $options['dateFormat'] . '&quot;</w:instrText></w:r>';
        $runs .= '<w:r>' . $rPrContent . '<w:fldChar w:fldCharType="separate" /></w:r>';
        $runs .= '<w:r>' . $rPrContent . '<w:t>date</w:t></w:r>';
        $runs .= '<w:r>' . $rPrContent . '<w:fldChar w:fldCharType="end" /></w:r>';

        $date = '<w:p>' . $pPrContent . $runs . '</w:p>';

        PhpdocxLogger::logger('Add a date to word document.', 'info');

        $contentElement = (string)$date;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsR($contentElement);
        }

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }
    }

    /**
     * Adds an endnote
     *
     * @access public
     * @param array $options
     * Values:
     * 'textDocument'(mixed) a string of text to appear in the document body or an array with the text and associated text options
     * 'textEndnote' (mixed) a string of text to be used as the endnote text or a WordML fragment
     * 'textEndnotes' (array) multiple endnotes
     * 'endnoteMark' (array) bidi, customMark, font, fontSize, bold, italic, color, rtl
     * 'referenceMark' (array) bidi, font, fontSize, bold, italic, color, rtl
     */
    public function addEndnote($options = array())
    {
        $class = get_class($this);

        if (!isset($options['endnoteMark'])) {
            $options['endnoteMark'] = null;
        }
        if (!isset($options['referenceMark'])) {
            $options['referenceMark'] = null;
        }

        $options['endnoteMark'] = self::translateTextOptions2StandardFormat($options['endnoteMark']);
        $options['endnoteMark'] = self::setRTLOptions($options['endnoteMark']);
        $options['referenceMark'] = self::translateTextOptions2StandardFormat($options['referenceMark']);
        $options['referenceMark'] = self::setRTLOptions($options['referenceMark']);

        // if there's no textEndnotes a single endnote will be added
        if (!isset($options['textEndnotes'])) {
            $options['textEndnotes'] = array();
            $options['textEndnotes'][0]['textEndnote'] = $options['textEndnote'];
            if (isset($options['endnoteMark'])) {
                $options['textEndnotes'][0]['endnoteMark'] = $options['endnoteMark'];
            }
            if (isset($options['referenceMark'])) {
                $options['textEndnotes'][0]['referenceMark'] = $options['referenceMark'];
            }
        }

        $endnoteDocument = new WordFragment();
        if (count($options['textEndnotes']) > 0) {
            if (!is_array($options['textDocument'])) {
                $options['textDocument'] = array('text' => $options['textDocument']);
            }
            $textOptions = $options['textDocument'];
            $textOptions = self::setRTLOptions($textOptions);
            $text = $textOptions['text'];
            $endnoteDocument->addText($text, $textOptions);
            foreach ($options['textEndnotes'] as $textEndnotes) {
                $id = self::uniqueNumberId(9999, 32766); //this number can not be bigger or equal than 32767
                if (!isset($textEndnotes['endnoteMark'])) {
                    $textEndnotes['endnoteMark'] = null;
                }
                if (!isset($textEndnotes['referenceMark'])) {
                    $textEndnotes['referenceMark'] = null;
                }

                $textEndnotes['endnoteMark'] = self::translateTextOptions2StandardFormat($textEndnotes['endnoteMark']);
                $textEndnotes['endnoteMark'] = self::setRTLOptions($textEndnotes['endnoteMark']);
                $textEndnotes['referenceMark'] = self::translateTextOptions2StandardFormat($textEndnotes['referenceMark']);
                $textEndnotes['referenceMark'] = self::setRTLOptions($textEndnotes['referenceMark']);
                if ($textEndnotes['textEndnote'] instanceof WordFragment) {
                    $endnoteBase = '<w:endnote w:id="' . $id . '"
                        xmlns:ve="http://schemas.openxmlformats.org/markup-compatibility/2006"
                        xmlns:o="urn:schemas-microsoft-com:office:office"
                        xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
                        xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math"
                        xmlns:v="urn:schemas-microsoft-com:vml"
                        xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing"
                        xmlns:w10="urn:schemas-microsoft-com:office:word"
                        xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"
                        xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml"
                        >';
                    $endnoteBase .= $this->parseWordMLNote('endnote', $textEndnotes['textEndnote'], $textEndnotes['endnoteMark'], $textEndnotes['referenceMark']);
                    $endnoteBase = preg_replace('/__PHX=__[A-Z]+__/', '', $endnoteBase);
                    $endnoteBase .= '</w:endnote>';
                } else {
                    $endnoteBase = '<w:endnote w:id="' . $id . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:p>
                        <w:pPr><w:pStyle w:val="endnoteTextPHPDOCX"/>';
                    if (self::$bidi) {
                        $endnoteBase .= '<w:bidi />';
                    }
                    $endnoteBase .= '</w:pPr>';
                    if (self::$trackingEnabled == true) {
                        $endnoteBase .= '<w:ins w:author="'.self::$trackingOptions['author'].'" w:date="'.self::$trackingOptions['date'].'" w:id="'.self::$trackingOptions['id'].'">';

                        self::$trackingOptions['id'] = self::$trackingOptions['id'] + 1;
                    }
                    $endnoteBase .= '<w:r><w:rPr><w:rStyle w:val="endnoteReferencePHPDOCX"/>';

                    //Parse the referenceMark options
                    if (isset($textEndnotes['referenceMark']['font'])) {
                        $endnoteBase .= '<w:rFonts w:ascii="' . $textEndnotes['referenceMark']['font'] .
                                '" w:hAnsi="' . $textEndnotes['referenceMark']['font'] .
                                '" w:eastAsia="' . $textEndnotes['referenceMark']['font'] .
                                '" w:cs="' . $textEndnotes['referenceMark']['font'] . '"/>';
                    }
                    if (isset($textEndnotes['referenceMark']['b'])) {
                        $endnoteBase .= '<w:b w:val="' . $textEndnotes['referenceMark']['b'] . '"/>';
                        $endnoteBase .= '<w:bCs w:val="' . $textEndnotes['referenceMark']['b'] . '"/>';
                    }
                    if (isset($textEndnotes['referenceMark']['i'])) {
                        $endnoteBase .= '<w:i w:val="' . $textEndnotes['referenceMark']['i'] . '"/>';
                        $endnoteBase .= '<w:iCs w:val="' . $textEndnotes['referenceMark']['i'] . '"/>';
                    }
                    if (isset($textEndnotes['referenceMark']['color'])) {
                        $endnoteBase .= '<w:color w:val="' . $textEndnotes['referenceMark']['color'] . '"/>';
                    }
                    if (isset($textEndnotes['referenceMark']['sz'])) {
                        $endnoteBase .= '<w:sz w:val="' . (2 * $textEndnotes['referenceMark']['sz']) . '"/>';
                        $endnoteBase .= '<w:szCs w:val="' . (2 * $textEndnotes['referenceMark']['sz']) . '"/>';
                    }
                    if (isset($textEndnotes['referenceMark']['rtl']) && $textEndnotes['referenceMark']['rtl']) {
                        $endnoteBase .= '<w:rtl />';
                    }
                    $endnoteBase .= '</w:rPr>';
                    if (isset($textEndnotes['endnoteMark']['customMark'])) {
                        $endnoteBase .= '<w:t>' . $textEndnotes['endnoteMark']['customMark'] . '</w:t>';
                    } else {
                        $endnoteBase .= '<w:endnoteRef/>';
                    }
                    $endnoteBase .= '</w:r>';
                    $endnoteBase .= '<w:r>';
                    if (isset($textEndnotes['endnoteMark']['font']) ||
                        isset($textEndnotes['endnoteMark']['b']) ||
                        isset($textEndnotes['endnoteMark']['i']) ||
                        isset($textEndnotes['endnoteMark']['color']) ||
                        isset($textEndnotes['endnoteMark']['sz']) ||
                        isset($textEndnotes['endnoteMark']['rtl']) && $textEndnotes['endnoteMark']['rtl']) {
                        $endnoteBase .= '<w:rPr>';

                        // parse the endnoteMark options
                        if (isset($textEndnotes['endnoteMark']['font'])) {
                            $endnoteBase .= '<w:rFonts w:ascii="' . $textEndnotes['endnoteMark']['font'] .
                                    '" w:hAnsi="' . $textEndnotes['endnoteMark']['font'] .
                                    '" w:eastAsia="' . $textEndnotes['endnoteMark']['font'] .
                                    '" w:cs="' . $textEndnotes['endnoteMark']['font'] . '"/>';
                        }
                        if (isset($textEndnotes['endnoteMark']['b'])) {
                            $endnoteBase .= '<w:b w:val="' . $textEndnotes['endnoteMark']['b'] . '"/>';
                            $endnoteBase .= '<w:bCs w:val="' . $textEndnotes['endnoteMark']['b'] . '"/>';
                        }
                        if (isset($textEndnotes['endnoteMark']['i'])) {
                            $endnoteBase .= '<w:i w:val="' . $textEndnotes['endnoteMark']['i'] . '"/>';
                            $endnoteBase .= '<w:iCs w:val="' . $textEndnotes['endnoteMark']['i'] . '"/>';
                        }
                        if (isset($textEndnotes['endnoteMark']['color'])) {
                            $endnoteBase .= '<w:color w:val="' . $textEndnotes['endnoteMark']['color'] . '"/>';
                        }
                        if (isset($textEndnotes['endnoteMark']['sz'])) {
                            $endnoteBase .= '<w:sz w:val="' . (2 * $textEndnotes['endnoteMark']['sz']) . '"/>';
                            $endnoteBase .= '<w:szCs w:val="' . (2 * $textEndnotes['endnoteMark']['sz']) . '"/>';
                        }
                        if (isset($textEndnotes['endnoteMark']['rtl']) && $textEndnotes['endnoteMark']['rtl']) {
                            $endnoteBase .= '<w:rtl />';
                        }

                        $endnoteBase .= '</w:rPr>';
                    }

                    $endnoteBase .= '<w:t xml:space="preserve">' . htmlspecialchars($textEndnotes['textEndnote']) . '</w:t></w:r>';
                    if (self::$trackingEnabled == true) {
                        $endnoteBase .= '</w:ins>';

                        self::$trackingOptions['id'] = self::$trackingOptions['id'] + 1;
                    }
                    $endnoteBase .= '</w:p></w:endnote>';
                }
                $endnoteMark = '<w:r><w:rPr><w:rStyle w:val="endnoteReferencePHPDOCX" />';
                //Parse the endnoteMark options
                if (isset($textEndnotes['endnoteMark']['font'])) {
                    $endnoteMark .= '<w:rFonts w:ascii="' . $textEndnotes['endnoteMark']['font'] .
                            '" w:hAnsi="' . $textEndnotes['endnoteMark']['font'] .
                            '" w:eastAsia="' . $textEndnotes['endnoteMark']['font'] .
                            '" w:cs="' . $textEndnotes['endnoteMark']['font'] . '"/>';
                }
                if (isset($textEndnotes['endnoteMark']['b'])) {
                    $endnoteMark .= '<w:b w:val="' . $textEndnotes['endnoteMark']['b'] . '"/>';
                    $endnoteMark .= '<w:bCs w:val="' . $textEndnotes['endnoteMark']['b'] . '"/>';
                }
                if (isset($textEndnotes['endnoteMark']['i'])) {
                    $endnoteMark .= '<w:i w:val="' . $textEndnotes['endnoteMark']['i'] . '"/>';
                    $endnoteMark .= '<w:iCs w:val="' . $textEndnotes['endnoteMark']['i'] . '"/>';
                }
                if (isset($textEndnotes['endnoteMark']['color'])) {
                    $endnoteMark .= '<w:color w:val="' . $textEndnotes['endnoteMark']['color'] . '"/>';
                }
                if (isset($textEndnotes['endnoteMark']['sz'])) {
                    $endnoteMark .= '<w:sz w:val="' . (2 * $textEndnotes['endnoteMark']['sz']) . '"/>';
                    $endnoteMark .= '<w:szCs w:val="' . (2 * $textEndnotes['endnoteMark']['sz']) . '"/>';
                }
                if (isset($textEndnotes['endnoteMark']['rtl']) && $textEndnotes['endnoteMark']['rtl']) {
                    $endnoteMark .= '<w:rtl />';
                }
                $endnoteMark .= '</w:rPr><w:endnoteReference w:id="' . $id . '" ';
                if (isset($textEndnotes['endnoteMark']['customMark'])) {
                    $endnoteMark .= 'w:customMarkFollows="1"/><w:t>' . $textEndnotes['endnoteMark']['customMark'] . '</w:t>';
                } else {
                    $endnoteMark .= '/>';
                }
                $endnoteMark .= '</w:r></w:p>';
                $endnoteDocument = str_replace('</w:p>', $endnoteMark, $endnoteDocument);
                //Clean the endnoteDocument from auxilairy variable
                $endnoteDocument = preg_replace('/__PHX=__[A-Z]+__/', '', $endnoteDocument);

                $tempNode = $this->_wordEndnotesT->createDocumentFragment();
                $tempNode->appendXML($endnoteBase);
                $this->_wordEndnotesT->documentElement->appendChild($tempNode);
            }
        }

        PhpdocxLogger::logger('Add endnote to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= (string) $endnoteDocument;
        } else {
            $this->_wordDocumentC .= (string) $endnoteDocument;
        }
    }

    /**
     * Embeds a external DOCX, HTML, MHT or RTF file
     *
     * @access public
     * @param array $options
     * 'src' (string) path to the external file
     * 'matchSource' (bool) if true (default value) tries to preserve as much as posible the styles of the docx to be included
     * 'preprocess' (bool) if true does some preprocessing on the docx file to add
     * @return void
     * @throws Exception invalid file extension, file does not exist
     */
    public function addExternalFile($options)
    {
       if (file_exists($options['src'])) {
            $extension = strtolower(pathinfo($options['src'], PATHINFO_EXTENSION));
            if ($extension == 'docx') {
                $this->addDOCX($options);
            } elseif ($extension == 'html') {
                $this->addHTML($options);
            } elseif ($extension == 'mht') {
                $this->addMHT($options);
            } elseif ($extension == 'rtf') {
                $this->addRTF($options);
            } else {
                PhpdocxLogger::logger('Invalid file extension', 'fatal');
            }
        } else {
            PhpdocxLogger::logger('The file does not exist', 'fatal');
        }
    }

    /**
     * Add a footer
     *
     * @access public
     * @param array $footer
     * @param array
     *  Values:
     * 'default'(object) WordFragment
     * 'even' (object) WordFragment
     * 'first' (object) WordFragment
     * @throws Exception not using WordFragments
     */
    public function addFooter($footers)
    {
        $this->removeFooters();
        foreach ($footers as $key => $value) {
            if ($value instanceof WordFragment) {
                $this->_wordFooterT[$key] = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
                                            <w:ftr
                                                xmlns:ve="http://schemas.openxmlformats.org/markup-compatibility/2006"
                                                xmlns:o="urn:schemas-microsoft-com:office:office"
                                                xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
                                                xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math"
                                                xmlns:v="urn:schemas-microsoft-com:vml"
                                                xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing"
                                                xmlns:w10="urn:schemas-microsoft-com:office:word"
                                                xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"
                                                xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml">';
                $this->_wordFooterT[$key] .= (string) $value;
                $this->_wordFooterT[$key] .= '</w:ftr>';
                $this->_wordFooterT[$key] = preg_replace('/__PHX=__[A-Z]+__/', '', $this->_wordFooterT[$key]);
                // first insert image rels
                // then insert external images rels
                // then insert link rels
                $relationships = '';
                if (isset(CreateDocx::$_relsHeaderFooterImage[$key . 'Footer'])) {
                    foreach (CreateDocx::$_relsHeaderFooterImage[$key . 'Footer'] as $key2 => $value2) {
                        $relationships .= '<Relationship Id="' . $value2['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/img' . $value2['rId'] . '.' . $value2['extension'] . '" />';
                    }
                }
                if (isset(CreateDocx::$_relsHeaderFooterExternalImage[$key . 'Footer'])) {
                    foreach (CreateDocx::$_relsHeaderFooterExternalImage[$key . 'Footer'] as $key2 => $value2) {
                        $relationships .= '<Relationship Id="' . $value2['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="' . $value2['url'] . '" TargetMode="External" />';
                    }
                }
                if (isset(CreateDocx::$_relsHeaderFooterLink[$key . 'Footer'])) {
                    foreach (CreateDocx::$_relsHeaderFooterLink[$key . 'Footer'] as $key2 => $value2) {
                        $relationships .= '<Relationship Id="' . $value2['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink" Target="' . $value2['url'] . '" TargetMode="External" />';
                    }
                }
                // create the complete rels file relative to that footer
                if ($relationships != '') {
                    $rels = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">';
                    $rels .= $relationships;
                    $rels .= '</Relationships>';
                }
                // include the footer xml files
                $this->saveToZip($this->_wordFooterT[$key], 'word/' . $key . 'Footer.xml');
                // include the footer rels files
                if (isset($rels)) {
                    $this->saveToZip($rels, 'word/_rels/' . $key . 'Footer.xml.rels');
                }
                // modify the document.xml.rels file
                $newId = uniqid(mt_rand(999, 9999));
                $newFooterNode = '<Relationship Id="rId';
                $newFooterNode .= $newId . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/footer"';
                $newFooterNode .= ' Target="' . $key . 'Footer.xml" />';
                $newNode = $this->_wordRelsDocumentRelsT->createDocumentFragment();
                $newNode->appendXML($newFooterNode);
                $baseNode = $this->_wordRelsDocumentRelsT->documentElement;
                $baseNode->appendChild($newNode);
                //7. modify accordingly the sectPr node
                $newSectNode = '<w:footerReference w:type="' . $key . '" r:id="rId' . $newId . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"/>';
                $sectNode = $this->_sectPr->createDocumentFragment();
                $sectNode->appendXML($newSectNode);
                $refNode = $this->_sectPr->documentElement->childNodes->item(0);
                $refNode->parentNode->insertBefore($sectNode, $refNode);
                if ($key == 'first') {
                    $this->generateTitlePg(false);
                } else if ($key == 'even') {
                    $this->generateSetting('w:evenAndOddHeaders');
                }
                // generate the corresponding Override element in [Content_Types].xml
                $this->generateOVERRIDE(
                        '/word/' . $key . 'Footer.xml', 'application/vnd.openxmlformats-officedocument.wordprocessingml.' .
                        'footer+xml'
                );
                // refresh the _relsFooter array
                $this->_relsFooter[] = $key . 'Footer.xml';
                // refresh the arrays used to hold the image and link data
                CreateDocx::$_relsHeaderFooterImage[$key . 'Footer'] = array();
                CreateDocx::$_relsHeaderFooterExternalImage[$key . 'Footer'] = array();
                CreateDocx::$_relsHeaderFooterLink[$key . 'Footer'] = array();
            } else {
                PhpdocxLogger::logger('The footer contents must be WordML fragments', 'fatal');
            }
        }
    }

    /**
     * Adds a footnote
     *
     * @access public
     * @param array $options
     *  Values:
     * 'textDocument'(mixed) a string of text to appear in the document body or an array with the text and associated text options
     * 'textFootnote' (mixed) a string of text to be used as the footnote text or a WordML fragment
     * 'textFootnotes' (array) multiple footnotes
     * 'footnoteMark' (array) bidi, customMark, font, fontSize, bold, italic, color, rtl
     * 'referenceMark' (array) bidi, font, fontSize, bold, italic, color, rtl
     */
    public function addFootnote($options = array())
    {
        $class = get_class($this);

        if (!isset($options['footnoteMark'])) {
            $options['footnoteMark'] = null;
        }
        if (!isset($options['referenceMark'])) {
            $options['referenceMark'] = null;
        }
        $options['footnoteMark'] = self::translateTextOptions2StandardFormat($options['footnoteMark']);
        $options['footnoteMark'] = self::setRTLOptions($options['footnoteMark']);
        $options['referenceMark'] = self::translateTextOptions2StandardFormat($options['referenceMark']);
        $options['referenceMark'] = self::setRTLOptions($options['referenceMark']);

        // if there's no textFootnotes a single footnote will be added
        if (!isset($options['textFootnotes'])) {
            $options['textFootnotes'] = array();
            $options['textFootnotes'][0]['textFootnote'] = $options['textFootnote'];
            if (isset($options['footnoteMark'])) {
                $options['textFootnotes'][0]['footnoteMark'] = $options['footnoteMark'];
            }
            if (isset($options['referenceMark'])) {
                $options['textFootnotes'][0]['referenceMark'] = $options['referenceMark'];
            }
        }

        $footnoteDocument = new WordFragment();
        if (count($options['textFootnotes']) > 0) {
            if (!is_array($options['textDocument'])) {
                $options['textDocument'] = array('text' => $options['textDocument']);
            }
            $textOptions = $options['textDocument'];
            $textOptions = self::setRTLOptions($textOptions);
            $text = $textOptions['text'];
            $footnoteDocument->addText($text, $textOptions);
            foreach ($options['textFootnotes'] as $textFootnotes) {
                $id = self::uniqueNumberId(9999, 32766); //this number can not be bigger or equal than 32767

                if (!isset($textFootnotes['footnoteMark'])) {
                    $textFootnotes['footnoteMark'] = null;
                }
                if (!isset($textFootnotes['referenceMark'])) {
                    $textFootnotes['referenceMark'] = null;
                }

                $textFootnotes['footnoteMark'] = self::translateTextOptions2StandardFormat($textFootnotes['footnoteMark']);
                $textFootnotes['footnoteMark'] = self::setRTLOptions($textFootnotes['footnoteMark']);
                $textFootnotes['referenceMark'] = self::translateTextOptions2StandardFormat($textFootnotes['referenceMark']);
                $textFootnotes['referenceMark'] = self::setRTLOptions($textFootnotes['referenceMark']);

                if ($textFootnotes['textFootnote'] instanceof WordFragment) {
                    $footnoteBase = '<w:footnote w:id="' . $id . '"
                        xmlns:ve="http://schemas.openxmlformats.org/markup-compatibility/2006"
                        xmlns:o="urn:schemas-microsoft-com:office:office"
                        xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
                        xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math"
                        xmlns:v="urn:schemas-microsoft-com:vml"
                        xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing"
                        xmlns:w10="urn:schemas-microsoft-com:office:word"
                        xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"
                        xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml"
                        >';
                    $footnoteBase .= $this->parseWordMLNote('footnote', $textFootnotes['textFootnote'], $textFootnotes['footnoteMark'], $textFootnotes['referenceMark']);
                    $footnoteBase = preg_replace('/__PHX=__[A-Z]+__/', '', $footnoteBase);
                    $footnoteBase .= '</w:footnote>';
                } else {
                    $footnoteBase = '<w:footnote w:id="' . $id . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:p>
                        <w:pPr><w:pStyle w:val="footnoteTextPHPDOCX"/>';
                    if (self::$bidi) {
                        $footnoteBase .= '<w:bidi />';
                    }
                    $footnoteBase .= '</w:pPr>';
                    if (self::$trackingEnabled == true) {
                        $footnoteBase .= '<w:ins w:author="'.self::$trackingOptions['author'].'" w:date="'.self::$trackingOptions['date'].'" w:id="'.self::$trackingOptions['id'].'">';

                        self::$trackingOptions['id'] = self::$trackingOptions['id'] + 1;
                    }
                    $footnoteBase .= '<w:r><w:rPr><w:rStyle w:val="footnoteReferencePHPDOCX"/>';
                    // parse the referenceMark options
                    if (isset($textFootnotes['referenceMark']['font'])) {
                        $footnoteBase .= '<w:rFonts w:ascii="' . $textFootnotes['referenceMark']['font'] .
                                '" w:hAnsi="' . $textFootnotes['referenceMark']['font'] .
                                '" w:eastAsia="' . $textFootnotes['referenceMark']['font'] .
                                '" w:cs="' . $textFootnotes['referenceMark']['font'] . '"/>';
                    }
                    if (isset($textFootnotes['referenceMark']['b'])) {
                        $footnoteBase .= '<w:b w:val="' . $textFootnotes['referenceMark']['b'] . '"/>';
                        $footnoteBase .= '<w:bCs w:val="' . $textFootnotes['referenceMark']['b'] . '"/>';
                    }
                    if (isset($textFootnotes['referenceMark']['i'])) {
                        $footnoteBase .= '<w:i w:val="' . $textFootnotes['referenceMark']['i'] . '"/>';
                        $footnoteBase .= '<w:iCs w:val="' . $textFootnotes['referenceMark']['i'] . '"/>';
                    }
                    if (isset($textFootnotes['referenceMark']['color'])) {
                        $footnoteBase .= '<w:color w:val="' . $textFootnotes['referenceMark']['color'] . '"/>';
                    }
                    if (isset($textFootnotes['referenceMark']['sz'])) {
                        $footnoteBase .= '<w:sz w:val="' . (2 * $textFootnotes['referenceMark']['sz']) . '"/>';
                        $footnoteBase .= '<w:szCs w:val="' . (2 * $textFootnotes['referenceMark']['sz']) . '"/>';
                    }
                    if (isset($textFootnotes['referenceMark']['rtl']) && $textFootnotes['referenceMark']['rtl']) {
                        $footnoteBase .= '<w:rtl />';
                    }
                    $footnoteBase .= '</w:rPr>';
                    if (isset($textFootnotes['footnoteMark']['customMark'])) {
                        $footnoteBase .= '<w:t>' . $textFootnotes['footnoteMark']['customMark'] . '</w:t>';
                    } else {
                        $footnoteBase .= '<w:footnoteRef/>';
                    }
                    $footnoteBase .= '</w:r>';
                    $footnoteBase .= '<w:r>';
                    if (isset($textFootnotes['footnoteMark']['font']) ||
                        isset($textFootnotes['footnoteMark']['b']) ||
                        isset($textFootnotes['footnoteMark']['i']) ||
                        isset($textFootnotes['footnoteMark']['color']) ||
                        isset($textFootnotes['footnoteMark']['sz']) ||
                        isset($textFootnotes['footnoteMark']['rtl']) && $textFootnotes['footnoteMark']['rtl']) {
                        $footnoteBase .= '<w:rPr>';

                        // parse the footnoteMark options
                        if (isset($textFootnotes['footnoteMark']['font'])) {
                            $footnoteBase .= '<w:rFonts w:ascii="' . $textFootnotes['footnoteMark']['font'] .
                                    '" w:hAnsi="' . $textFootnotes['footnoteMark']['font'] .
                                    '" w:eastAsia="' . $textFootnotes['footnoteMark']['font'] .
                                    '" w:cs="' . $textFootnotes['footnoteMark']['font'] . '"/>';
                        }
                        if (isset($textFootnotes['footnoteMark']['b'])) {
                            $footnoteBase .= '<w:b w:val="' . $textFootnotes['footnoteMark']['b'] . '"/>';
                            $footnoteBase .= '<w:bCs w:val="' . $textFootnotes['footnoteMark']['b'] . '"/>';
                        }
                        if (isset($textFootnotes['footnoteMark']['i'])) {
                            $footnoteBase .= '<w:i w:val="' . $textFootnotes['footnoteMark']['i'] . '"/>';
                            $footnoteBase .= '<w:iCs w:val="' . $textFootnotes['footnoteMark']['i'] . '"/>';
                        }
                        if (isset($textFootnotes['footnoteMark']['color'])) {
                            $footnoteBase .= '<w:color w:val="' . $textFootnotes['footnoteMark']['color'] . '"/>';
                        }
                        if (isset($textFootnotes['footnoteMark']['sz'])) {
                            $footnoteBase .= '<w:sz w:val="' . (2 * $textFootnotes['footnoteMark']['sz']) . '"/>';
                            $footnoteBase .= '<w:szCs w:val="' . (2 * $textFootnotes['footnoteMark']['sz']) . '"/>';
                        }
                        if (isset($textFootnotes['footnoteMark']['rtl']) && $textFootnotes['footnoteMark']['rtl']) {
                            $footnoteBase .= '<w:rtl />';
                        }

                        $footnoteBase .= '</w:rPr>';
                    }

                    $footnoteBase .= '<w:t xml:space="preserve">' . htmlspecialchars($textFootnotes['textFootnote']) . '</w:t></w:r>';
                    if (self::$trackingEnabled == true) {
                        $footnoteBase .= '</w:ins>';

                        self::$trackingOptions['id'] = self::$trackingOptions['id'] + 1;
                    }
                    $footnoteBase .= '</w:p></w:footnote>';
                }
                $footnoteMark = '<w:r><w:rPr><w:rStyle w:val="footnoteReferencePHPDOCX" />';
                // parse the footnoteMark options
                if (isset($textFootnotes['footnoteMark']['font'])) {
                    $footnoteMark .= '<w:rFonts w:ascii="' . $textFootnotes['footnoteMark']['font'] .
                            '" w:hAnsi="' . $textFootnotes['footnoteMark']['font'] .
                            '" w:eastAsia="' . $textFootnotes['footnoteMark']['font'] .
                            '" w:cs="' . $textFootnotes['footnoteMark']['font'] . '"/>';
                }
                if (isset($textFootnotes['footnoteMark']['b'])) {
                    $footnoteMark .= '<w:b w:val="' . $textFootnotes['footnoteMark']['b'] . '"/>';
                    $footnoteMark .= '<w:bCs w:val="' . $textFootnotes['footnoteMark']['b'] . '"/>';
                }
                if (isset($textFootnotes['footnoteMark']['i'])) {
                    $footnoteMark .= '<w:i w:val="' . $textFootnotes['footnoteMark']['i'] . '"/>';
                    $footnoteMark .= '<w:iCs w:val="' . $textFootnotes['footnoteMark']['i'] . '"/>';
                }
                if (isset($textFootnotes['footnoteMark']['color'])) {
                    $footnoteMark .= '<w:color w:val="' . $textFootnotes['footnoteMark']['color'] . '"/>';
                }
                if (isset($textFootnotes['footnoteMark']['sz'])) {
                    $footnoteMark .= '<w:sz w:val="' . (2 * $textFootnotes['footnoteMark']['sz']) . '"/>';
                    $footnoteMark .= '<w:szCs w:val="' . (2 * $textFootnotes['footnoteMark']['sz']) . '"/>';
                }
                if (isset($textFootnotes['footnoteMark']['rtl']) && $textFootnotes['footnoteMark']['rtl']) {
                    $footnoteMark .= '<w:rtl />';
                }
                $footnoteMark .= '</w:rPr><w:footnoteReference w:id="' . $id . '" ';
                if (isset($textFootnotes['footnoteMark']['customMark'])) {
                    $footnoteMark .= 'w:customMarkFollows="1"/><w:t>' . $textFootnotes['footnoteMark']['customMark'] . '</w:t>';
                } else {
                    $footnoteMark .= '/>';
                }
                $footnoteMark .= '</w:r></w:p>';
                $footnoteDocument = str_replace('</w:p>', $footnoteMark, $footnoteDocument);
                // clean the footnoteDocument from auxilairy variable
                $footnoteDocument = preg_replace('/__PHX=__[A-Z]+__/', '', $footnoteDocument);

                $tempNode = $this->_wordFootnotesT->createDocumentFragment();
                $tempNode->appendXML($footnoteBase);
                $this->_wordFootnotesT->documentElement->appendChild($tempNode);
            }
        }

        PhpdocxLogger::logger('Add footnote to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= (string) $footnoteDocument;
        } else {
            $this->_wordDocumentC .= (string) $footnoteDocument;
        }
    }

    /**
     * Add a Form element (text field, select or checkbox)
     *
     * @access public
     * @param mixed $type it can be 'textfield', 'checkbox' or 'select'
     * @param array $options Style options to apply to the text
     *  Values:
     * 'pStyle' (string) Word style to be used. Run parseStyles() to check all available paragraph styles
     * 'backgroundColor' (string) hexadecimal value (FFFF00, CCCCCC, ...)
     * 'bidi' (bool) if true sets right to left paragraph orientation
     * 'bold' (bool)
     * 'border' (none, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *      this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom' and 'borderLeft'
     * 'borderColor' (ffffff, ff0000)
     *      this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor' and 'borderLeftColor'
     * 'borderSpacing' (0, 1, 2...)
     *      this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing' and 'borderLeftSpacing'
     * 'borderWidth' (10, 11...) in eights of a point
     *      this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth' and 'borderLeftWidth'
     *
     * 'caps' (bool) display text in capital letters
     * 'color' (ffffff, ff0000...)
     * 'contextualSpacing' (bool) ignore spacing above and below when using identical styles
     * 'em' (none, dot, circle, comma, underDot) emphasis mark type
     * 'firstLineIndent' first line indent in twentieths of a point (twips)
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (8, 9, 10, ...) size in points
     * 'hanging' 100, 200, ...
     * 'headingLevel' (int) the heading level, if any
     * 'italic' (bool)
     * 'indentLeft' 100, ...
     * 'indentRight' 100, ...
     * 'textAlign' (both, center, distribute, left, right)
     * 'keepLines' (bool) keep all paragraph lines on the same page
     * 'keepNext' (bool) keep in the same page the current paragraph with next paragraph
     * 'lineSpacing' 120, 240 (standard), 360, 480...
     * 'pageBreakBefore' (bool)
     * 'rtl' (bool) if true sets right to left text orientation
     * 'smallCaps' (bool) displays text in small capital letters
     * 'spacingBottom' (int) bottom margin in twentieths of a point
     * 'spacingTop' (int) top margin in twentieths of a point
     * 'suppressLineNumbers' (bool) suppress line numbers
     * 'tabPositions' (array) each entry is an associative array with the following keys and values
     *      'type' (string) can be clear, left (default), center, right, decimal, bar and num
     *      'leader' (string) can be none (default), dot, hyphen, underscore, heavy and middleDot
     *      'position' (int) given in twentieths of a point
     *  if there is a tab and the tabPositions array is not defined the standard tab position (default of 708) will be used
     * 'textDirection' (lrTb, tbRl, btLr, lrTbV, tbRlV, tbLrV) text flow direction
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * 'widowControl' (bool)
     * 'wordWrap' (bool)
     * 'defaultValue' (mixed) a string of text for the textfield type,
     * a boolean value for the checkbox type or an integer representing the index (0 based)
     * for the options of a select form element
     * 'selectOptions' (array) an array of options for the dropdown menu
     * @throws Exception form element type not available
     */
    public function addFormElement($type, $options = array())
    {
        $options = self::setRTLOptions($options);
        $class = get_class($this);
        $formElementTypes = array('textfield', 'checkbox', 'select');
        if (!in_array($type, $formElementTypes)) {
            PhpdocxLogger::logger('The chosen form element type is not available', 'fatal');
        }
        $formElementBase = CreateText::getInstance();
        $paragraphOptions = $options;
        $formElementBase = new WordFragment();
        $formElementBase->addText(array(array('text' => '__PHX=__formElement__')), $paragraphOptions);
        $formElement = CreateFormElement::getInstance();
        $formElement->createFormElement($type, $options, (string) $formElementBase);

        $contentElement = (string)$formElement;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsR($contentElement);
        }

        PhpdocxLogger::logger('Add form element to Word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }
    }

    /**
     * Add a header
     *
     * @access public
     * @param array $headers
     *  Values:
     * 'default'(object) WordFragment
     * 'even' (object) WordFragment
     * 'first' (object) WordFragment
     * @throws Exception not using WordFragments
     */
    public function addHeader($headers)
    {
        $this->removeHeaders();
        foreach ($headers as $key => $value) {
            if ($value instanceof WordFragment) {
                $this->_wordHeaderT[$key] = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>
                                            <w:hdr
                                                xmlns:ve="http://schemas.openxmlformats.org/markup-compatibility/2006"
                                                xmlns:o="urn:schemas-microsoft-com:office:office"
                                                xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"
                                                xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math"
                                                xmlns:v="urn:schemas-microsoft-com:vml"
                                                xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing"
                                                xmlns:w10="urn:schemas-microsoft-com:office:word"
                                                xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"
                                                xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml">';
                $this->_wordHeaderT[$key] .= (string) $value;
                $this->_wordHeaderT[$key] .= '</w:hdr>';
                $this->_wordHeaderT[$key] = preg_replace('/__PHX=__[A-Z]+__/', '', $this->_wordHeaderT[$key]);
                // first insert image Rels
                // then insert external images rels
                // then insert Link rels
                $relationships = '';
                if (isset(CreateDocx::$_relsHeaderFooterImage[$key . 'Header'])) {
                    foreach (CreateDocx::$_relsHeaderFooterImage[$key . 'Header'] as $key2 => $value2) {
                        $relationships .= '<Relationship Id="' . $value2['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/img' . $value2['rId'] . '.' . $value2['extension'] . '" />';
                    }
                }
                if (isset(CreateDocx::$_relsHeaderFooterExternalImage[$key . 'Header'])) {
                    foreach (CreateDocx::$_relsHeaderFooterExternalImage[$key . 'Header'] as $key2 => $value2) {
                        $relationships .= '<Relationship Id="' . $value2['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="' . $value2['url'] . '" TargetMode="External" />';
                    }
                }
                if (isset(CreateDocx::$_relsHeaderFooterLink[$key . 'Header'])) {
                    foreach (CreateDocx::$_relsHeaderFooterLink[$key . 'Header'] as $key2 => $value2) {
                        $relationships .= '<Relationship Id="' . $value2['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink" Target="' . $value2['url'] . '" TargetMode="External" />';
                    }
                }
                // create the complete rels file relative to that header
                if ($relationships != '') {
                    $rels = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">';
                    $rels .= $relationships;
                    $rels .= '</Relationships>';
                }
                // include the header xml files
                $this->saveToZip($this->_wordHeaderT[$key], 'word/' . $key . 'Header.xml');
                // include the header rels files
                if (isset($rels)) {
                    $this->saveToZip($rels, 'word/_rels/' . $key . 'Header.xml.rels');
                }
                // modify the document.xml.rels file
                $newId = uniqid(mt_rand(999, 9999));
                $newHeaderNode = '<Relationship Id="rId';
                $newHeaderNode .= $newId . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/header"';
                $newHeaderNode .= ' Target="' . $key . 'Header.xml" />';
                $newNode = $this->_wordRelsDocumentRelsT->createDocumentFragment();
                $newNode->appendXML($newHeaderNode);
                $baseNode = $this->_wordRelsDocumentRelsT->documentElement;
                $baseNode->appendChild($newNode);
                // modify accordingly the sectPr node
                $newSectNode = '<w:headerReference w:type="' . $key . '" r:id="rId' . $newId . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"/>';
                $sectNode = $this->_sectPr->createDocumentFragment();
                $sectNode->appendXML($newSectNode);
                $refNode = $this->_sectPr->documentElement->childNodes->item(0);
                $refNode->parentNode->insertBefore($sectNode, $refNode);
                if ($key == 'first') {
                    $this->generateTitlePg(false);
                } else if ($key == 'even') {
                    $this->generateSetting('w:evenAndOddHeaders');
                }
                // generate the corresponding Override element in [Content_Types].xml
                $this->generateOVERRIDE(
                        '/word/' . $key . 'Header.xml', 'application/vnd.openxmlformats-officedocument.wordprocessingml.' .
                        'header+xml'
                );
                // refresh the _relsHeader array
                $this->_relsHeader[] = $key . 'Header.xml';
                // refresh the arrays used to hold the image and link data
                CreateDocx::$_relsHeaderFooterImage[$key . 'Header'] = array();
                CreateDocx::$_relsHeaderFooterExternalImage[$key . 'Header'] = array();
                CreateDocx::$_relsHeaderFooterLink[$key . 'Header'] = array();
            } else {
                PhpdocxLogger::logger('The header contents must be WordML fragments', 'fatal');
            }
        }
    }

    /**
     * Adds a heading to the Word document
     *
     * @access public
     * @param string $text the heading text
     * @param int $level can be 1 (default), 2, 3, ...
     * @param array $options Style options to apply to the heading
     *  Values:
     * 'pStyle' (string) Word style to be used. Run parseStyles() to check all available paragraph styles
     * 'backgroundColor' (string) hexadecimal value (FFFF00, CCCCCC, ...)
     * 'bidi' (bool) if true sets right to left paragraph orientation
     * 'bold' (bool)
     * 'border' (none, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *      this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom' and 'borderLeft'
     * 'borderColor' (ffffff, ff0000)
     *      this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor' and 'borderLeftColor'
     * 'borderSpacing' (0, 1, 2...)
     *      this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing' and 'borderLeftSpacing'
     * 'borderWidth' (10, 11...) in eights of a point
     *      this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth' and 'borderLeftWidth'
     *
     * 'caps' (bool) display text in capital letters
     * 'color' (ffffff, ff0000...)
     * 'contextualSpacing' (bool) ignore spacing above and below when using identical styles
     * 'doubleStrikeThrough' (bool)
     * 'em' (none, dot, circle, comma, underDot) emphasis mark type
     * 'emboss' (bool) emboss style
     * 'firstLineIndent' first line indent in twentieths of a point (twips)
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (8, 9, 10, ...) size in points
     * 'hanging' 100, 200, ...
     * 'headingLevel' (int) the heading level, if any
     * 'italic' (bool)
     * 'indentLeft' 100, ...
     * 'indentRight' 100, ...
     * 'textAlign' (both, center, distribute, left, right)
     * 'keepLines' (bool) keep all paragraph lines on the same page
     * 'keepNext' (bool) keep in the same page the current paragraph with next paragraph
     * 'lineSpacing' 120, 240 (standard), 360, 480...
     * 'noProof' (bool) ignore spelling and grammar errors
     * 'outline' (bool) outline style
     * 'pageBreakBefore' (bool)
     * 'position' (int) position value, positive value for raised and negative value for lowered
     * 'rtl' (bool) if true sets right to left text orientation
     * 'scaling' (int) scaling value, 100 is the default value
     * 'shadow' (bool) shadow style
     * 'smallCaps' (bool) displays text in small capital letters
     * 'spacing' (int) character spacing, positive value for expanded and negative value for condensed
     * 'spacingBottom' (int) bottom margin in twentieths of a point
     * 'spacingTop' (int) top margin in twentieths of a point
     * 'strikeThrough' (bool)
     * 'suppressLineNumbers' (bool) suppress line numbers
     * 'tabPositions' (array) each entry is an associative array with the following keys and values
     *      'type' (string) can be clear, left (default), center, right, decimal, bar and num
     *      'leader' (string) can be none (default), dot, hyphen, underscore, heavy and middleDot
     *      'position' (int) given in twentieths of a point
     *  if there is a tab and the tabPositions array is not defined the standard tab position (default of 708) will be used
     * 'textDirection' (lrTb, tbRl, btLr, lrTbV, tbRlV, tbLrV) text flow direction
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * 'underlineColor' (ffffff, ff0000, ...)
     * 'vanish' (bool)
     * 'widowControl' (bool)
     * 'wordWrap' (bool)
     */
    public function addHeading($text, $level = 1, $options = array())
    {
        $options = self::translateTextOptions2StandardFormat($options);
        $options = self::setRTLOptions($options);
        $class = get_class($this);

        if (!isset($options['b'])) {
            $options['b'] = 'on';
        }
        if (!isset($options['keepLines'])) {
            $options['keepLines'] = 'on';
        }
        if (!isset($options['keepNext'])) {
            $options['keepNext'] = 'on';
        }
        if (!isset($options['widowControl'])) {
            $options['widowControl'] = 'on';
        }
        if (!isset($options['sz'])) {
            $options['sz'] = max(15 - $level, 10);
        }
        if (!isset($options['font'])) {
            $options['font'] = 'Cambria';
        }

        $options['headingLevel'] = $level;
        $heading = CreateText::getInstance();
        $heading->createText($text, $options);

        $contentElement = (string)$heading;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsR($contentElement);
        }

        PhpdocxLogger::logger('Adds a heading of level ' . $level . 'to the Word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }
    }

    /**
     * Adds an image
     *
     * @access public
     * @param array $data
     * Values:
     * 'src' (string) path to the image or stream or base64 image
     * 'borderColor' (string)
     * 'borderStyle'(string) can be solid, dot, dash, lgDash, dashDot, lgDashDot, lgDashDotDot, sysDash, sysDot, sysDashDot, sysDashDotDot
     * 'borderWidth' (int) given in emus (1cm = 360000 emus)
     * 'caption' (array) keys:
     *     'showLabel' (bool): show default value (Figure)
     *     'label' (string): set a custom label (Figure by default)
     *     'text' (string): text of the caption
     *     'sz' (int): text size
     *     'color' (string): text color
     *     'lineSpacing' (int): text line spacing
     *     'styleName' (string): allow setting a custom style name, useful to generate table of figures based on style names
     *     'bookmarkName' (string): set a custom bookmark name
     * 'float' (left, right, center) floating image. It only applies if textWrap is not inline (default value).
     * 'horizontalOffset' (int) given in emus (1cm = 360000 emus). Only applies if there is the image is not floating
     * 'imageAlign' (center, left, right, inside, outside)
     * 'descr' (string) set a descr value
     * 'dpi' (int) dots per inch
     * 'height' (int) in pixels
     * 'hyperlink' (string)
     * 'mime' (string) forces a mime (image/jpg, image/jpeg, image/png, image/gif)
     * 'relativeToHorizontal' (string) margin (default), page, column, character, leftMargin, rightMargin, insideMargin, outsideMargin. Not compatible with inline text wrapping
     * 'relativeToVertical' (string) margin, page, line (default), paragraph, topMargin, bottomMargin, insideMargin, outsideMargin. Not compatible with inline text wrapping
     * 'scaling' (int) a pecentage: 50, 100, ..
     * 'spacingTop' (int) in pixels
     * 'spacingBottom' (int) in pixels
     * 'spacingLeft' (int) in pixels
     * 'spacingRight' (int) in pixels
     * 'streamMode' (bool) if true, uses src path as stream. PHP 5.4 or greater needed to autodetect the mime type; otherwise set it using mime option. Default is false
     * 'textWrap' 0 (inline), 1 (square), 2 (front), 3 (back), 4 (up and bottom)
     * 'verticalAlign' (string) top, center, bottom. To be used with relativeFromVertical
     * 'verticalOffset' (int) given in emus (1cm = 360000 emus)
     * 'width' (int) in pixels
     * @throws Exception image does not exist, image format not supported, getimagesizefromstring not available using streamMode
     */
    public function addImage($data = '')
    {
        if (isset($data['width'])) {
            $data['sizeX'] = $data['width'];
        }
        if (isset($data['height'])) {
            $data['sizeY'] = $data['height'];
        }
        $class = get_class($this);
        if ($class != 'CreateDocx' && isset($this->target)) {
            $data['target'] = $this->target;
        } else {
            $data['target'] = 'document';
        }

        $mimeType = '';
        $dir = array();
        $isBase64 = false;
        $imageContent = '';

        // file image
        if (isset($data['src']) && (!isset($data['streamMode']) || !$data['streamMode'])) {
            if ($data['src'] && strstr($data['src'], 'base64,')) {
                // check if base64
                $descrArray = explode(';base64,', $data['src']);
                $arrayExtension = explode('/', $descrArray[0]);
                $dir['extension'] = $arrayExtension[1];
                $arrayMime = explode(':', $descrArray[0]);
                $mimeType = $arrayMime[1];
                $imageContent = base64_decode($descrArray[1]);
                $isBase64 = true;
            } else if (file_exists($data['src'])) {
                $attrImage = getimagesize($data['src']);
                $mimeType = $attrImage['mime'];

                $dir = $this->parsePath($data['src']);
            } else {
                PhpdocxLogger::logger('Image does not exist.', 'fatal');
            }
        }

        // stream image
        if (isset($data['streamMode']) && $data['streamMode'] == true) {
            if (function_exists('getimagesizefromstring')) {
                $imageStream = file_get_contents($data['src']);
                $attrImage = getimagesizefromstring($imageStream);
                $mimeType = $attrImage['mime'];

                switch ($mimeType) {
                    case 'image/gif':
                        $dir['extension'] = 'gif';
                        break;
                    case 'image/jpg':
                        $dir['extension'] = 'jpg';
                        break;
                    case 'image/jpeg':
                        $dir['extension'] = 'jpeg';
                        break;
                    case 'image/png':
                        $dir['extension'] = 'png';
                        break;
                    case 'image/bmp':
                        $dir['extension'] = 'bmp';
                        break;
                    default:
                        break;
                }
            } else {
                if (!isset($data['mime'])) {
                    PhpdocxLogger::logger('getimagesizefromstring function is not available. Set the mime option or use the file mode.', 'fatal');
                }
            }
        }

        if (isset($data['mime']) && !empty($data['mime'])) {
            $mimeType = $data['mime'];
        }

        // check mime type
        if (!in_array($mimeType, array('image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/bmp'))) {
            PhpdocxLogger::logger('Image format is not supported.', 'fatal');
        }

        PhpdocxLogger::logger('Create image.', 'debug');
        try {
            self::$intIdWord++;
            PhpdocxLogger::logger('New ID rId' . self::$intIdWord . ' . Image.', 'debug');

            // generate hyperlink rId
            if (isset($data['hyperlink'])) {
                $data['rIdHyperlink'] = self::$intIdWord . 'link';
            }
            $image = CreateImage::getInstance();
            $data['rId'] = self::$intIdWord;
            $image->createImage($data);

            PhpdocxLogger::logger('Add image word/media/imgrId' .
                    self::$intIdWord . '.' . $dir['extension'] .
                    '.xml to DOCX.', 'info');
            if ($isBase64) {
                $this->_zipDocx->addContent('word/media/imgrId' . self::$intIdWord . '.' . $dir['extension'], $imageContent);
            } else {
                $this->_zipDocx->addFile('word/media/imgrId' . self::$intIdWord . '.' . $dir['extension'], $data['src']);
            }
            $this->generateDEFAULT($dir['extension'], $mimeType);
            if ((string) $image != '') {
                // consider the case where the image will be included in a header or footer
                if ($data['target'] == 'defaultHeader' ||
                        $data['target'] == 'firstHeader' ||
                        $data['target'] == 'evenHeader' ||
                        $data['target'] == 'defaultFooter' ||
                        $data['target'] == 'firstFooter' ||
                        $data['target'] == 'evenFooter') {
                    CreateDocx::$_relsHeaderFooterImage[$data['target']][] = array('rId' => 'rId' . self::$intIdWord, 'extension' => $dir['extension']);
                    if (isset($data['hyperlink'])) {
                        CreateDocx::$_relsHeaderFooterLink[$data['target']][] = array('rId' => 'rId' . $data['rIdHyperlink'], 'url' => $data['hyperlink'], 'TargetMode' => 'External');
                    }
                } else if ($data['target'] == 'footnote' ||
                        $data['target'] == 'endnote' ||
                        $data['target'] == 'comment') {
                    CreateDocx::$_relsNotesImage[$data['target']][] = array('rId' => 'rId' . self::$intIdWord, 'extension' => $dir['extension']);
                    if (isset($data['hyperlink'])) {
                        CreateDocx::$_relsNotesLink[$data['target']][] = array('rId' => 'rId' . $data['rIdHyperlink'], 'url' => $data['hyperlink'], 'TargetMode' => 'External');
                    }
                } else {
                    $this->generateRELATIONSHIP(
                            'rId' . self::$intIdWord, 'image', 'media/imgrId' . self::$intIdWord . '.'
                            . $dir['extension']
                    );
                    if (isset($data['hyperlink'])) {
                        $this->generateRELATIONSHIP(
                            'rId' . $data['rIdHyperlink'], 'hyperlink', $data['hyperlink'], 'TargetMode="External"'
                        );
                    }
                }
            }

            $contentElement = (string)$image;

            if (self::$trackingEnabled == true) {
                $tracking = new Tracking();
                $contentElement = $tracking->addTrackingInsR($contentElement);
            }

            if ($class == 'WordFragment') {
                $this->wordML .= $contentElement;
                if (isset($data['caption'])) {
                    if (!isset($data['caption']['label'])) {
                        $data['caption']['label'] = 'Figure';
                    }
                    $data['caption']['align'] = ($data['imageAlign']) ? $data['imageAlign'] : 'left';
                    $this->addImageCaption(true, $data['caption']);
                }
            } else {
                $this->_wordDocumentC .= $contentElement;
                if (isset($data['caption'])) {
                    if (!isset($data['caption']['label'])) {
                        $data['caption']['label'] = 'Figure';
                    }
                    $data['caption']['align'] = ($data['imageAlign']) ? $data['imageAlign'] : 'left';
                    $this->addImageCaption(false, $data['caption']);
                }
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
    }

    /**
     * Adds line numbering
     *
     * @access public
     * @param array $options
     * countBy (int) line number increments to display (default value is 1)
     * start (int) initial line number (default value is 1)
     * distance (int) separation in twentieths of a point between the number and the text (defaults to auto)
     * restart (string) could be:
     *      continuous (default value: the numbering does not get restarted anywhere in the document),
     *      newPage (the numbering restarts at the beginning of every page)
     *      newSection (the numbering restarts at the beginning of every section)
     * sectionNumbers (array) if empty it will apply to all sections
     */
    public function addLineNumbering($options = array())
    {
        // restart condition available types
        $restart_types = array('continuous', 'newPage', 'newSection');
        $lineNumberOptions = array();
        // set defaults
        if (isset($options['countBy']) && is_int($options['countBy'])) {
            $lineNumberOptions['countBy'] = $options['countBy'];
        } else {
            $lineNumberOptions['countBy'] = 1;
        }
        if (isset($options['start']) && is_int($options['start'])) {
            $lineNumberOptions['start'] = $options['start'];
        } else {
            $lineNumberOptions['start'] = 0;
        }
        if (isset($options['distance']) && is_int($options['distance'])) {
            $lineNumberOptions['distance'] = $options['distance'];
        }
        if (isset($options['restart']) && in_array($options['restart'], $restart_types)) {
            $lineNumberOptions['restart'] = $options['restart'];
        } else {
            $lineNumberOptions['restart'] = 'continuous';
        }
        if (!isset($options['sectionNumbers'])) {
            $options['sectionNumbers'] = null;
        }
        // get the current sectPr nodes
        $sectPrNodes = $this->getSectionNodes($options['sectionNumbers']);
        // modify them
        foreach ($sectPrNodes as $sectionNode) {
            $this->modifySingleSectionProperty($sectionNode, 'lnNumType', $lineNumberOptions);
        }
        $this->restoreDocumentXML();
    }

    /**
     * Add a link
     *
     * @access public
     * @param array $options
     * @see addText
     * additional parameter:
     * 'url' (string) URL or #bookmarkName
     * 'rStyle' (string) apply a custom rStyle to links
     * @throws Exception linked text or url are missing
     */
    public function addLink($text, $options = array())
    {
        if (!isset($options['color'])) {
            $options['color'] = '0000ff';
        }
        if (!isset($options['u']) && !isset($options['underline'])) {
            $options['underline'] = 'single';
        }
        $options = self::setRTLOptions($options);
        $class = get_class($this);
        $options['url'] = htmlspecialchars($options['url']);
        if (substr($options['url'], 0, 1) == '#') {
            $url = 'HYPERLINK \l "' . substr($options['url'], 1) . '"';
        } else {
            $url = 'HYPERLINK "' . $options['url'] . '"';
        }
        if ($text == '') {
            PhpdocxLogger::logger('The linked text is missing', 'fatal');
        } else if ($options['url'] == '') {
            PhpdocxLogger::logger('The URL is missing', 'fatal');
        }

        // create an array to apply a rStyle
        if (!isset($options['rStyle']) || empty($options['rStyle'])) {
            $options['rStyle'] = 'DefaultParagraphFontPHPDOCX';
        }
        $text = array(
            array(
                'text' => $text,
            )
        );
        $text[0] += $options;
        // avoid adding rStyle to w:pPr, as it's not needed
        unset($options['rStyle']);

        $textOptions = $options;
        $link = new WordFragment();
        $link->addText($text, $textOptions);
        $link = preg_replace('/__PHX=__[A-Z]+__/', '', $link);
        $startNodes = '<w:r><w:fldChar w:fldCharType="begin" /></w:r><w:r>
        <w:instrText xml:space="preserve">' . $url . '</w:instrText>
        </w:r><w:r><w:fldChar w:fldCharType="separate" /></w:r>';
        if (strstr($link, '</w:pPr>')) {
            $link = preg_replace('/<\/w:pPr>/', '</w:pPr>' . $startNodes, $link);
        } else {
            $link = preg_replace('/<w:p>/', '<w:p>' . $startNodes, $link);
        }
        $endNode = '<w:r><w:fldChar w:fldCharType="end" /></w:r>';
        $link = preg_replace('/<\/w:p>/', $endNode . '</w:p>', $link);

        $contentElement = (string)$link;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsR($contentElement);
        }

        PhpdocxLogger::logger('Add link to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }
    }

    /**
     * Add a list
     *
     * @access public
     * @param array $data Values of the list
     * @param string $styleType (mixed), 0 (clear), 1 (inordinate), 2 (numerical) or the name of the created list
     * @param array $options formatting parameters for the text of all list items
     *  Values:
     * 'bold' (bool)
     * 'caps' (bool) display text in capital letters
     * 'color' (ffffff, ff0000, ...)
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (8, 9, 10, ...) size in points
     * 'highlightColor' (string) available highlighting colors are: black, blue, cyan, green, magenta, red, yellow, white, darkBlue, darkCyan, darkGreen, darkMagenta, darkRed, darkYellow, darkGray, lightGray, none.
     * 'italic' (bool)
     * 'numId' (positive int) useful to generate a continuous numbering
     * 'outlineLvl' (int) heading level
     * 'pStyle' (string) paragraph style name
     * 'smallCaps' (bool) displays text in small capital letters
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * 'useWordFragmentStyles' (bool) use WordFragment paragraph styles. Default as false
     */
    public function addList($data, $styleType = 1, $options = array())
    {
        $options['val'] = (int) $styleType;
        $class = get_class($this);
        $list = CreateList::getInstance();

        if ($options['val'] == 2) {
            self::$numOL++;
            $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, OOXMLResources::$orderedListStyle, self::$numOL);
        }
        if (is_string($styleType)) {
            $options['val'] = self::$customLists[$styleType]['id'];
        }
        $list->createList($data, $options);

        $contentElement = (string)$list;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsList($contentElement);
        }

        PhpdocxLogger::logger('Add list to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }
    }

    /**
     * Add a macro from a DOC
     *
     * @access public
     * @param string $path Path to a file with macro
     * @throws Exception not DOCM base template, the file can't be open
     */
    public function addMacroFromDoc($path)
    {

        if (!$this->_docm) {
            PhpdocxLogger::logger('The base template should be a docm to include a macro in your document.', 'fatal');
        }
        try {
            $package = new ZipArchive();
            $openZip = $package->open($path);
            if ($openZip !== true) {
                throw new Exception('Error while trying to open the given .docm');
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
        PhpdocxLogger::logger('Open document with a macro.', 'info');
        // copy the contents of vbaData
        $vbaData = $package->getFromName('word/vbaData.xml');
        $vbaBin = $package->getFromName('word/vbaProject.bin');
        PhpdocxLogger::logger('Add macro files to DOCX file.', 'info');
        // copy the contents
        $this->saveToZip($vbaData, 'word/vbaData.xml');
        $this->saveToZip($vbaBin, 'word/vbaProject.bin');
        $package->close();
    }

    /**
     * Add an existing math equation to DOCX
     *
     * @access public
     * @param string $equation DOCX file with an equation, OMML equation string or MML
     * @param string $type Type of equation: docx, omml, mathml
     * @param array $options
     *  Values:
     *      'align' (string) left, center, right
     *      'bold' (bool)
     *      'color' (string) : ffffff, ff0000...
     *      'fontSize' (int) : 8, 9, 10...
     *      'italic' (bool)
     *      'underline' (string) : single...
     */
    public function addMathEquation($equation, $type, $options = array())
    {
        $stylesMathEq = '';
        if (isset($options['align'])) {
            $stylesMathEq = '<m:oMathParaPr><m:jc m:val="'.$options['align'].'"/></m:oMathParaPr>';
        }
        if ($type == 'docx') {
            $package = new ZipArchive();
            PhpdocxLogger::logger('Open document with an existing math eq.', 'info');
            $package->open($equation);
            $document = $package->getFromName('word/document.xml');
            $eqs = preg_split('/<[\/]*m:oMathPara>/', $document);
            PhpdocxLogger::logger('Add math eq to word document.', 'info');
            $class = get_class($this);

            // apply styles if exist
            if (is_array($options) && count($options) > 0) {
                $eqs[1] = $this->applyMathEquationStyles($eqs[1], $options);
            }

            if ($class == 'WordFragment') {
                $this->wordML .= '<m:oMathPara>' . $eqs[1] . '</m:oMathPara>';
            } else {
                $this->_wordDocumentC .= '<' . CreateDocx::NAMESPACEWORD . ':p>' .
                        '<m:oMathPara>' . $stylesMathEq . $eqs[1] . '</m:oMathPara>' .
                        '</' . CreateDocx::NAMESPACEWORD . ':p>';
            }
            $package->close();
        } elseif ($type == 'omml') {
            $class = get_class($this);
            PhpdocxLogger::logger('Add existing math eq to word document.', 'info');

            // apply styles if exist
            if (is_array($options) && count($options) > 0) {
                $equation = $this->applyMathEquationStyles((string) $equation, $options);
            }

            if ($class == 'WordFragment') {
                $this->wordML .= (string) $equation;
            } else {
                $this->_wordDocumentC .= '<' . CreateDocx::NAMESPACEWORD . ':p>' .
                        (string) $equation . '</' . CreateDocx::NAMESPACEWORD . ':p>';
            }
        } elseif ($type == 'mathml') {
            $class = get_class($this);
            $math = CreateMath::getInstance();
            PhpdocxLogger::logger('Convert MathML eq.', 'debug');
            $math->createMath($equation);

            // apply styles if exist
            if (is_array($options) && count($options) > 0) {
                $math = $this->applyMathEquationStyles((string) $math, $options);
            }

            PhpdocxLogger::logger('Add converted MathML eq to word document.', 'info');
            if ($class == 'WordFragment') {
                $this->wordML .= '<m:oMathPara>' . $stylesMathEq . (string) $math . '</m:oMathPara>';
            } else {
                $this->_wordDocumentC .= '<' . CreateDocx::NAMESPACEWORD . ':p>' .
                        '<m:oMathPara>' . $stylesMathEq . (string) $math . '</m:oMathPara>' .
                        '</' . CreateDocx::NAMESPACEWORD . ':p>';
            }
        }
    }

    /**
     * Adds a merge field to the Word document
     *
     * @access public
     * @param string $name
     * @param array $mergeParameters
     * Keys and values:
     * 'format' (Caps, FirstCap, Lower, Upper)
     * 'mappedField' (bool)
     * 'preserveFormat' (bool)
     * 'textAfter' string of text to include after the merge field
     * 'textBefore' string of text to include before the merge field
     * 'verticalFormat' (bool)
     * @param array $options style options to apply to the field
     * For the available options @see addText
     *
     */
    public function addMergeField($name, $mergeParameters = array(), $options = array())
    {
        $options = self::setRTLOptions($options);
        $class = get_class($this);
        if (!isset($mergeParameters['preserveFormat'])) {
            $mergeParameters['preserveFormat'] = true;
        }

        $fieldName = '';
        if (isset($mergeParameters['textBefore'])) {
            $fieldName .= $mergeParameters['textBefore'];
        }
        $fieldName .= '«' . $name . '»';
        if (isset($mergeParameters['textAfter'])) {
            $fieldName .= $mergeParameters['textAfter'];
        }

        $simpleField = new WordFragment();
        $simpleField->addText($fieldName, $options);

        $data = 'MERGEFIELD &quot;' . $name . '&quot; ';
        foreach ($mergeParameters as $key => $value) {
            switch ($key) {
                case 'textBefore':
                    $data .= '\b &quot;' . htmlspecialchars($value) . '&quot; ';
                    break;
                case 'textAfter':
                    $data .= '\f &quot;' . htmlspecialchars($value) . '&quot; ';
                    break;
                case 'mappedField':
                    if ($value) {
                        $data .= '\m ';
                    }
                    break;
                case 'verticalFormat':
                    if ($value) {
                        $data .= '\v ';
                    }
                    break;
                case 'preserveFormat':
                    if ($value) {
                        $data .= '\* MERGEFORMAT';
                    }
                    break;
            }
        }

        $beguin = '<w:fldSimple w:instr=" ' . $data . ' ">';
        $end = '</w:fldSimple>';

        $simpleField = str_replace('<w:r>', $beguin . '<w:r>', $simpleField);
        $simpleField = str_replace('</w:r>', '</w:r>' . $end, $simpleField);

        $contentElement = (string)$simpleField;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsR($contentElement);
        }

        PhpdocxLogger::logger('Adding a merge field to the Word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }
    }

    /**
     * Adds an online video to document. Compatible from MS Word 2013, if older or other DOCX reader set as link
     *
     * @access public
     * @param string $src URL of the video
     * @param array options
     *        'image' (string) use a custom image as video preview, black color otherwise
     *        'height' (int) in pixels, 315 as default
     *        'hyperlink' (string) $src if not set
     *        'width' (int) in pixels, 560 as default
     * @throws Exception method not available, image does not exist, image format not supported
     */
    public function addOnlineVideo($src, $options = array())
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        $options['src'] = $src;
        if (isset($options['width'])) {
            $options['sizeX'] = $options['width'];
        } else {
            $options['sizeX'] = 560;
        }
        if (isset($options['height'])) {
            $options['sizeY'] = $options['height'];
        } else {
            $options['sizeY'] = 315;
        }
        if (!isset($options['hyperlink'])) {
            $options['hyperlink'] = $options['src'];
        }
        if (!isset($options['image'])) {
            $options['image'] = dirname(__FILE__) . '/../templates/black.png';
        }

        $class = get_class($this);
        if ($class != 'CreateDocx' && isset($this->target)) {
            $options['target'] = $this->target;
        } else {
            $options['target'] = 'document';
        }

        $mimeType = '';
        $dir = array();

        // file image
        if (isset($options['image'])) {
            if (file_exists($options['image'])) {
                $attrImage = getimagesize($options['image']);
                $mimeType = $attrImage['mime'];

                $dir = $this->parsePath($options['image']);
            } else {
                PhpdocxLogger::logger('Image does not exist.', 'fatal');
            }
        }

        if (isset($options['mime']) && !empty($options['mime'])) {
            $mimeType = $options['mime'];
        }

        // check mime type
        if (!in_array($mimeType, array('image/jpg', 'image/jpeg', 'image/png', 'image/gif'))) {
            PhpdocxLogger::logger('Image format is not supported.', 'fatal');
        }

        PhpdocxLogger::logger('Create online video.', 'debug');
        try {
            // image preview
            self::$intIdWord++;
            PhpdocxLogger::logger('New ID rId' . self::$intIdWord . ' . Image.', 'debug');
            $this->_zipDocx->addFile('word/media/imgrId' . self::$intIdWord . '.' . $dir['extension'], $options['image']);
            $this->generateDEFAULT($dir['extension'], $mimeType);
            $options['rIdImage'] = self::$intIdWord;

            // online video
            self::$intIdWord++;
            PhpdocxLogger::logger('New ID rId' . self::$intIdWord . ' . Online video.', 'debug');

            // generate hyperlink rId
            $options['rIdHyperlink'] = self::$intIdWord . 'link';

            $video = CreateOnlineVideo::getInstance();
            $options['rId'] = self::$intIdWord;
            $video->createOnlineVideo($options);

            if ((string) $video != '') {
                // consider the case where the content will be included in a header or footer
                if ($options['target'] == 'defaultHeader' ||
                        $options['target'] == 'firstHeader' ||
                        $options['target'] == 'evenHeader' ||
                        $options['target'] == 'defaultFooter' ||
                        $options['target'] == 'firstFooter' ||
                        $options['target'] == 'evenFooter') {
                    CreateDocx::$_relsHeaderFooterImage[$options['target']][] = array('rId' => 'rId' . $options['rIdImage'], 'extension' => $dir['extension']);
                    CreateDocx::$_relsHeaderFooterLink[$options['target']][] = array('rId' => 'rId' . $options['rIdHyperlink'], 'url' => $options['hyperlink'], 'TargetMode' => 'External');
                } else if ($options['target'] == 'footnote' ||
                        $options['target'] == 'endnote' ||
                        $options['target'] == 'comment') {
                    CreateDocx::$_relsNotesImage[$options['target']][] = array('rId' => 'rId' . $options['rIdImage'], 'extension' => $dir['extension']);
                    CreateDocx::$_relsNotesLink[$options['target']][] = array('rId' => 'rId' . $options['rIdHyperlink'], 'url' => $options['hyperlink'], 'TargetMode' => 'External');
                } else {
                    $this->generateRELATIONSHIP('rId' . $options['rIdImage'], 'image', 'media/imgrId' . $options['rIdImage'] . '.' . $dir['extension']);
                    $this->generateRELATIONSHIP('rId' . $options['rIdHyperlink'], 'hyperlink', $options['hyperlink'], 'TargetMode="External"');
                }
            }

            $contentElement = (string)$video;

            if (self::$trackingEnabled == true) {
                $tracking = new Tracking();
                $contentElement = $tracking->addTrackingInsR($contentElement);
            }

            if ($class == 'WordFragment') {
                $this->wordML .= $contentElement;
            } else {
                $this->_wordDocumentC .= $contentElement;
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
    }

    /**
     * Adds page borders
     *
     * @access public
     * @param array $options (<side> stands for top, right, bottom or left)
     * 'zOrder' (int)
     * 'display' (string) posible values are:allPages (display page border on all pages, default value),
     *  firstPage(display page border on first page), notFirstPage (display page border on all pages except first)
     * 'offsetFrom' (string) posible values are: page or text
     * 'borderStyle' (nil, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *       this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom' and 'borderLeft'
     * 'borderColor' (ffffff, ff0000)
     *      this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor' and 'borderLeftColor'
     * 'borderSpacing' (0, 1, 2...)
     *      this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing' and 'borderLeftSpacing'
     * 'borderWidth' (10, 11...) in eights of a point
     *      this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth' and 'borderLeftWidth'
     * sectionNumbers (array)
     */
    public function addPageBorders($options = array())
    {
        if (!isset($options['sectionNumbers'])) {
            $options['sectionNumbers'] = null;
        }

        $options = CreateDocx::translateTableOptions2StandardFormat($options);

        //Get the current sectPr nodes
        $sectPrNodes = $this->getSectionNodes($options['sectionNumbers']);
        //Modify them
        foreach ($sectPrNodes as $sectionNode) {
            $this->modifyPageBordersSectionProperty($sectionNode, $options);
        }
        $this->restoreDocumentXML();
    }

    /**
     * Adds a page number to the document
     * WARNING: if the page number is not added to a header or footer the user may
     * need to press F9 in the MS Word interface to update its value to the current page
     *
     * @access public
     * @param mixed $type (String): numerical, alphabetical, page-of
     * @param array $options Style options to apply to the numbering
     * Numerical and alphabetical
     *  Values:
     * 'bidi' (bool)
     * 'bold' (bool)
     * 'color' (ffffff, ff0000...)
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (int) size in half points
     * 'italic' (bool)
     * 'indentLeft' (int) distange in twentieths of a point (twips)
     * 'indentRight' (int) distange in twentieths of a point (twips)
     * 'pageBreakBefore' (bool)
     * 'textAlign' (both, center, distribute, left, right)
     * 'underline' (dash, dotted, double, single, wave, words)
     * 'widowControl' (bool)
     * 'wordWrap' (bool)
     * 'lineSpacing' 120, 240 (standard), 480, ...
     * 'defaultValue' (int)
     * Page-of
     *  Values:
     * 'pStyle' pStyle name (Footer as default)
     * 'textAlign' center (default), left, right
     */
    public function addPageNumber($type = 'numerical', $options = array('defaultValue' => 1))
    {
        $options = self::setRTLOptions($options);
        $class = get_class($this);
        if (!isset($options['defaultValue'])) {
            if ($type == 'numerical') {
                $options['defaultValue'] = '1';
            } else if ($type == 'alphabetical') {
                $options['defaultValue'] = 'a';
            }
        }

        if ($type == 'page-of') {
            // page-of number
            if (!isset($options['pStyle'])) {
                $options['pStyle'] = 'Footer';
            }
            if (!isset($options['textAlign'])) {
                $options['textAlign'] = 'center';
            }
            $pageNumber = OOXMLResources::$pageNumber;
            $pageNumber = str_replace(
                array('__ID__PAGENUMBER__SDTPR__', '__ID__PAGENUMBER__SDTCONTENT__', '__PSTYLE__PAGENUMBER__PPR__', '__JC__PAGENUMBER__PPR__'),
                array(rand(100000000, 999999999), rand(100000000, 999999999), $options['pStyle'], $options['textAlign']),
                $pageNumber
            );

        } else {
            // numerical and alphabetical number
            $pageNumber = new WordFragment();
            $pageNumber->addText($options['defaultValue'], $options);

            if ($type == 'alphabetical') {
                $beguin = '<w:fldSimple w:instr="PAGE \* alphabetic \* MERGEFORMAT">';
            } else {
                $beguin = '<w:fldSimple w:instr="PAGE \* MERGEFORMAT">';
            }
            $end = '</w:fldSimple>';
            $pageNumber = str_replace('<w:r>', $beguin . '<w:r>', (string) $pageNumber);
            $pageNumber = str_replace('</w:r>', '</w:r>' . $end, (string) $pageNumber);
        }
        PhpdocxLogger::logger('Add page number to word document.', 'info');
        if ($class == 'WordFragment') {
            $this->wordML .= (string) $pageNumber;
        } else {
            $this->_wordDocumentC .= (string) $pageNumber;
        }
    }

    /**
     * Adds people to document
     *
     * @access public
     * @param array $person Person information
     *   'author' (string). Required
     *   'providerId' (string). Optional, None as default
     *   'userId' (string). Optional, author value as default
     * @throws Exception method not available, missing author name
     */
    public function addPerson($person)
    {
        if (!file_exists(dirname(__FILE__) . '/Tracking.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        if (!isset($person['author'])) {
            PhpdocxLogger::logger('The author name is required.', 'fatal');
        }

        if (!isset($person['providerId'])) {
            $person['providerId'] = 'None';
        }

        if (!isset($person['userId'])) {
            $person['userId'] = $person['author'];
        }

        $tracking = new Tracking();
        $this->_wordDocumentPeople = $tracking->addPerson($this->_wordDocumentPeople, $person);
    }

    /**
     * Add properties to document
     *
     * @access public
     * @param array $values Parameters to use
     *  Values: 'title', 'subject', 'creator', 'keywords', 'description', 'created' (W3CDTF without time zone), 'modified' (W3CDTF without time zone), lastModifiedBy,
     *  'category', 'contentStatus', 'Manager','Company', 'custom' ('name' => array('type' => 'value')), 'revision'
     */
    public function addProperties($values)
    {
        $this->_modifiedDocxProperties = true;
        self::$propsCore = $this->getFromZip('docProps/core.xml', 'DOMDocument');
        self::$propsApp = $this->getFromZip('docProps/app.xml', 'DOMDocument');
        self::$propsCustom = $this->getFromZip('docProps/custom.xml', 'DOMDocument');
        if (self::$propsCustom === false) {
            self::$generateCustomRels = true;
            self::$propsCustom = new DOMDocument();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            self::$propsCustom->loadXML(OOXMLResources::$customProperties);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
            // write the new Override node associated to the new custon.xml file en [Content_Types].xml
            $this->generateOVERRIDE(
                    '/docProps/custom.xml', 'application/vnd.openxmlformats-officedocument.' .
                    'custom-properties+xml'
            );
            $this->saveToZip(self::$propsCustom, 'docProps/custom.xml');
        }
        self::$relsRels = $this->getFromZip('_rels/.rels', 'DOMDocument');


        $prop = CreateProperties::getInstance();
        if (!empty($values['title']) || !empty($values['subject']) || !empty($values['creator']) || !empty($values['keywords']) || !empty($values['description']) || !empty($values['category']) || !empty($values['contentStatus']) || !empty($values['created']) || !empty($values['modified']) || !empty($values['lastModifiedBy']) || !empty($values['revision']) ) {
            self::$propsCore = $prop->createProperties($values, self::$propsCore);
        }
        if (isset($values['contentStatus']) && $values['contentStatus'] == 'Final') {
            self::$propsCustom = $prop->createPropertiesCustom(array('_MarkAsFinal' => array('boolean' => 'true')), self::$propsCustom);
        }
        if (!empty($values['Manager']) || !empty($values['Company'])) {
            self::$propsApp = $prop->createPropertiesApp($values, self::$propsApp);
        }
        if (!empty($values['custom']) && is_array($values['custom'])) {
            self::$propsCustom = $prop->createPropertiesCustom($values['custom'], self::$propsCustom);
            // write the new Override node associated to the new custon.xml file en [Content_Types].xml
            $this->generateOVERRIDE(
                    '/docProps/custom.xml', 'application/vnd.openxmlformats-officedocument.' .
                    'custom-properties+xml'
            );
        }
        if (self::$generateCustomRels) {
            $this->generateCUSTOMRELS();
            self::$generateCustomRels = false;
        }
        PhpdocxLogger::logger('Adding properties to word document.', 'info');
    }

    /**
     * Adds a perm protection start or end tag to set editable regions in protected documents. To be used with protectDocx (CryptoPHPDOCX).
     * Using protectDocx the whole document is protected. Using this method regions can be excluded from the protection.
     *
     * @access public
     * @param string $type start, end
     * @throws Exception method not available
     */
    public function addPermProtection($type)
    {
        if (!file_exists(dirname(__FILE__) . '/CryptoPHPDOCX.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        $class = get_class($this);

        // generate a unique ID
        if ($type == 'start') {
            // start protection
            self::$_protectionID = mt_rand(1111111111, 9999999999);
            $protection = '<w:permStart w:edGrp="everyone" w:id="'.self::$_protectionID.'"/>';
        } else {
            $protection = '<w:permEnd w:id="'.self::$_protectionID.'"/>';
        }

        PhpdocxLogger::logger('Adds a ' . $type . ' protection to the Word document.', 'info');
        if ($class == 'WordFragment') {
            $this->wordML .= (string)$protection;
        } else {
            $this->_wordDocumentC .= (string)$protection;
        }
    }

    /**
     * Adds a section
     *
     * @access public
     * @param string sectionType (string): nextPage, nextColumn, continuous, evenPage, oddPage
     * @param array paperType (string): A4, A3, letter, legal, A4-landscape, A3-landscape, letter-landscape, legal-landscape, custom
     * @param array options
     * Values:
     * width (int): measurement in twips (twentieths of a point)
     * height (int): measurement in twips (twentieths of a point)
     * numberCols (int): number of columns
     * orient (string): portrait, landscape
     * marginTop (int): measurement in twips (twentieths of a point)
     * marginRight (int): measurement in twips (twentieths of a point)
     * marginBottom (int): measurement in twips (twentieths of a point)
     * marginLeft (int): measurement in twips (twentieths of a point)
     * marginHeader (int): measurement in twips (twentieths of a point)
     * marginFooter (int): measurement in twips (twentieths of a point)
     * space (int): column spacing, measurement in twips (twentieths of a point)
     * gutter (int): measurement in twips (twentieths of a point)
     * bidi (bool)
     * rtl (bool)
     * pageNumberType (array) with the following keys and values (all keys are needed):
     *     fmt (string): number format (cardinalText, decimal, decimalEnclosedCircle, decimalEnclosedFullstop, decimalEnclosedParen, decimalZero, lowerLetter, lowerRoman, none, ordinalText, upperLetter, upperRoman)
     *     start (int): page number
     * columns (array) allows generating a page layout with custom column numbers and sizes with the following keys and values:
     *     width (int)
     *     space (int)
     * endnotes (array) sets endnote options with the following keys and values:
     *     numFmt (string) numbering format: decimal, upperRoman, lowerRoman, upperLetter...
     *     numRestart (string) continuous, eachSect, eachPage
     *     numStart (int) starting value
     *     pos (string) sectEnd, docEnd
     * footnotes (array) sets footnote options with the following keys and values:
     *     numFmt (string) numbering format: decimal, upperRoman, lowerRoman, upperLetter...
     *     numRestart (string) continuous, eachSect, eachPage
     *     numStart (int) starting value
     *     pos (string) pageBottom, beneathText
     */
    public function addSection($sectionType = 'nextPage', $paperType = '', $options = array())
    {
        $options = self::translateTextOptions2StandardFormat($options);
        $options = self::setRTLOptions($options);
        if (empty($paperType)) {
            $paperType = $this->_phpdocxconfig['settings']['paper_size'];
        }
        $previousSectionPr = '<w:p><w:pPr>' . $this->_sectPr->saveXML() . '</w:pPr></w:p>';
        $previousSectionPr = str_replace('<?xml version="1.0"?>', '', $previousSectionPr);

        $contentElement = (string)$previousSectionPr;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsSection($contentElement);
        }

        $this->_wordDocumentC .= $contentElement;
        $options['onlyLastSection'] = true;
        $this->modifyPageLayout($paperType, $options);
        $nodeSz = $this->_sectPr->getElementsByTagName('pgSz')->item(0);
        $typeNode = $this->_sectPr->createDocumentFragment();
        $typeNode->appendXML('<w:type xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" w:val="' . $sectionType . '" />');
        $nodeSz->parentNode->insertBefore($typeNode, $nodeSz);
    }

    /**
     * Add a shape
     *
     * @access public
     * @param string $type Type of shape to draw
     *  Values: arc, curve, line, polyline, rect, roundrect, shape, oval
     * @param array $options
     * General options:
     * 'width' in points
     * 'height' in points
     * 'position' (absolute, relative)
     * 'marginTop' in points
     * 'marginLeft' in points
     * 'z-index' integer
     * 'strokecolor' (#ff0000, #00ffff, ...)
     * 'strokeweight' (1.0pt, 3.5pt, ...)
     * 'fillcolor' (#ff0000, #00ffff, ...)
     * 'textContent' it may be a Word fragment, a plain text string or an array with same parameters used in the addText method
     * 'imageContent' file path to the image to be added
     * The first array entry is the text to be included in the text box, the second one
     * is itself another array with all the standard text formatting options
     * Options for especific type:
     * arc: 'startAngle' (0, 45, 90, ...), 'endAngle' (0, 45, 90, ...)
     * line and curve: 'from' and 'to' (initial and final points in x,y format)
     * curve: 'control1' (x,y), 'control2' (x,y)
     * polyline: 'points' (x1,y1 x2,y2 ...)
     * roundrect: 'arcsize' (0.5, 1.8, ...)
     * shape: 'path' (VML path), 'coordsize' (x,y)
     * @throws Exception image does not exist, image format is not supported
     */
    public function addShape($type, $options = array())
    {
        if (!empty($options['marginTop'])) {
            $options['margin-top'] = $options['marginTop'];
        }
        if (!empty($options['marginLeft'])) {
            $options['margin-left'] = $options['marginLeft'];
        }

        $class = get_class($this);
        if ($class != 'CreateDocx' && isset($this->options)) {
            $options['target'] = $this->options;
        } else {
            $options['target'] = 'document';
        }

        if (isset($options['imageContent'])) {
            $mimeType = '';
            // file image
            if (file_exists($options['imageContent'])) {
                $attrImage = getimagesize($options['imageContent']);
                $mimeType = $attrImage['mime'];
                $dir = $this->parsePath($options['imageContent']);
            } else {
                PhpdocxLogger::logger('Image does not exist.', 'fatal');
            }
            // check mime type
            if (!in_array($mimeType, array('image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/bmp'))) {
                PhpdocxLogger::logger('Image format is not supported.', 'fatal');
            }

            self::$intIdWord++;
            $options['imageContentrId'] = self::$intIdWord;

            $this->_zipDocx->addFile('word/media/imgrId' . self::$intIdWord . '.' . $dir['extension'], $options['imageContent']);
            $this->generateDEFAULT($dir['extension'], $mimeType);
            // consider the case where the image will be included in a header or footer
            if ($options['target'] == 'defaultHeader' ||
                    $options['target'] == 'firstHeader' ||
                    $options['target'] == 'evenHeader' ||
                    $options['target'] == 'defaultFooter' ||
                    $options['target'] == 'firstFooter' ||
                    $options['target'] == 'evenFooter') {
                CreateDocx::$_relsHeaderFooterImage[$options['target']][] = array('rId' => 'rId' . self::$intIdWord, 'extension' => $dir['extension']);
            } else if ($options['target'] == 'footnote' ||
                    $options['target'] == 'endnote' ||
                    $options['target'] == 'comment') {
                CreateDocx::$_relsNotesImage[$options['target']][] = array('rId' => 'rId' . self::$intIdWord, 'extension' => $dir['extension']);
            } else {
                $this->generateRELATIONSHIP(
                        'rId' . self::$intIdWord, 'image', 'media/imgrId' . self::$intIdWord . '.'
                        . $dir['extension']
                );
            }
        }

        $class = get_class($this);
        $shape = new CreateShape();
        $shapeData = $shape->createShape($type, $options);

        $contentElement = '<w:r>' . (string)$shapeData . '</w:r>';

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsR($contentElement);
        }

        PhpdocxLogger::logger('Add a ' . $type . 'to the Word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= '<w:p>' . $contentElement . '</w:p>';
        } else {
            $paragraphShape = '<w:p>' . $contentElement . '</w:p>';
            $this->_wordDocumentC .= $paragraphShape;
        }
    }

    /**
     * Adds a simple field to the Word document
     * WARNING: if the page number is not added to a header or footer the user may
     * need to press F9 in the MS Word interface to update its value to the current page
     *
     * @access public
     * @param $fieldName the field value. Available fields are:
     * AUTHOR, COMMENTS, DOCPROPERTY, FILENAME, FILESIZE, KEYWORDS,
     * LASTSAVEDBY, NUMCHARS, NUMPAGES, NUMWORDS, SUBJECT, TEMPLATE, TITLE
     * @param string $type: date, numeric or general.
     * @param string $format
     * @param array $options style options to apply to the field
     * Values:
     * 'defaultValue' (mixed)
     * 'doNotShadeFormData' (bool)
     * 'updateFields' (bool)
     * For the available options @see addText
     */
    public function addSimpleField($fieldName, $type = 'general', $format = '', $options = array())
    {
        $options = self::setRTLOptions($options);
        $class = get_class($this);
        $availableTypes = array('date' => '\@', 'numeric' => '\#', 'general' => '\*');
        $fieldOptions = array();
        if (isset($options['doNotShadeFormData']) && $options['doNotShadeFormData']) {
            $fieldOptions['doNotShadeFormData'] = true;
        }
        if (isset($options['updateFields']) && $options['updateFields']) {
            $fieldOptions['updateFields'] = true;
        }
        if (count($fieldOptions) > 0) {
            $this->docxSettings($fieldOptions);
        }
        $simpleField = new WordFragment();
        $simpleField->addText($fieldName, $options);

        $data = $fieldName . ' ';
        if (!empty($format)) {
            $data .= $availableTypes[$type] . ' ' . $format . ' ';
        }
        $data .= '\* MERGEFORMAT';
        $beguin = '<w:fldSimple w:instr=" ' . $data . ' ">';

        $end = '</w:fldSimple>';
        $simpleField = str_replace('<w:r>', $beguin . '<w:r>', (string) $simpleField);
        $simpleField = str_replace('</w:r>', '</w:r>' . $end, (string) $simpleField);

        PhpdocxLogger::logger('Adding a simple field to the Word document.', 'info');
        // in order to preserve the run styles insert them within the <w:pPr> tag
        if ($class == 'WordFragment') {
            $this->wordML .= (string) $simpleField;
        } else {
            $this->_wordDocumentC .= (string) $simpleField;
        }
    }

    /**
     * Adds a source
     *
     * @param string $tag Specifies the tag name of a source, needed to add a citation
     * @param string $type Source type: Art, ArticleInAPeriodical, Book, BookSection, Case, ConferenceProceedings, DocumentFromInternetSite, ElectronicSource, Film, InternetSite, Interview, JournalArticle, Misc, Patent, Performance, Report, SoundRecording
     * @param array $author Author, Editor, Translator
     * @param array $info Source information: AbbreviatedCaseNumber, AlbumTitle, BookTitle, Broadcaster, BroadcastTitle, CaseNumber, ChapterNumber, City, Comments, ConferenceName, CountryRegion, Court, Day, DayAccessed, Department, Distributor, Edition, Institution, InternetSiteTitle, Issue, JournalName, LCID, Medium, Month, MonthAccessed, NumberVolumes, Pages, PatentNumber, PeriodicalTitle, ProductionCompany, PublicationTitle, Publisher, RecordingNumber, RefOrder, Reporter, ShortTitle, StandardNumber, StateProvince, Station, Theater, ThesisType, Title, Type, URL, Version, Volume, Year, YearAccessed
     * @param array $options
     * @throws Exception method not available
     */
    public function addSource($tag, $type, $author, $info, $options = array())
    {
        if (!file_exists(dirname(__FILE__) . '/CreateSource.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        $options = self::setRTLOptions($options);
        $class = get_class($this);

        $this->generateCustomXMLFiles();

        $source = CreateSource::getInstance();
        $source->createSource($tag, $type, $author, $info);

        $customXMLItem1ContentsDOM = $this->getFromZip('customXml/item1.xml', 'DOMDocument');
        $sourceNodes = $customXMLItem1ContentsDOM->createDocumentFragment();
        $prevValueLibXmlInternalErrors = libxml_use_internal_errors(true);
        $sourceNodes->appendXML((string)$source);
        libxml_clear_errors();
        libxml_use_internal_errors($prevValueLibXmlInternalErrors);
        $customXMLItem1ContentsDOM->documentElement->appendChild($sourceNodes);
        $customXMLItem1Contents = $customXMLItem1ContentsDOM->saveXML();
        // add XML header if needed
        if (!(strpos($customXMLItem1Contents, '<?xml ') === 0)) {
            $customXMLItem1Contents = '<?xml version="1.0" standalone="no"?>' . $customXMLItem1Contents;
        }
        $this->_zipDocx->addContent('customXml/item1.xml', $customXMLItem1Contents);

        PhpdocxLogger::logger('Add source to item1.xml document.', 'info');
    }

    /**
     * Add a Structured Document Tag
     *
     * @access public
     * @param mixed $type it can be 'checkbox', 'comboBox', 'date', 'dropDownList' or 'richText'
     * @param array $options Style options to apply to the text
     *  Values:
     * 'placeholderText (string) text to be shown by default
     * 'alias' (string) the label that will be shown by the structured document tag
     * 'lock' (string) locking properties: sdtLocked (cannot be deleted),
     * contentLocked (contents can not be edited directly), unlocked (default value: no locking) and sdtContentLocked (contents can not be directyly edited or the structured tag removed)
     * 'tag' (string) a programmatic tag
     * 'temporary' (bool) if true the structured tag is removed after editing
     * 'listItems' (array) an array of arrays each one of them containing the text to show and value
     * For other options @see addText
     * @throws Exception structured document tag type is not available
     */
    public function addStructuredDocumentTag($type, $options = array())
    {
        $options = self::setRTLOptions($options);
        $class = get_class($this);
        $sdtTypes = array('checkbox', 'comboBox', 'date', 'dropDownList', 'richText');
        if (!in_array($type, $sdtTypes)) {
            PhpdocxLogger::logger('The chosen Structured Document Tag type is not available', 'fatal');
        }
        $sdtBase = CreateText::getInstance();
        $paragraphOptions = $options;
        if ($type == 'checkbox') {
            if (isset($paragraphOptions['checked']) && $paragraphOptions['checked'] === true) {
                $paragraphOptions['text'] = '☒';
            } else {
                $paragraphOptions['text'] = '☐';
            }
        } else {
            $paragraphOptions['text'] = $options['placeholderText'];
        }
        $sdtBase->createText(array($paragraphOptions), $paragraphOptions);
        $sdt = CreateStructuredDocumentTag::getInstance();
        $sdt->createStructuredDocumentTag($type, $options, (string) $sdtBase);
        PhpdocxLogger::logger('Add Structured Document Tag to Word document.', 'info');
        if ($class == 'WordFragment') {
            $this->wordML .= (string) $sdt;
        } else {
            $this->_wordDocumentC .= (string) $sdt;
        }
    }

    /**
     * Adds an SVG content
     *
     * @access public
     * @param string $svg SVG path or svg content
     * @param width (int) in pixels
     * @param height (int) in pixels
     * @param array $data
     * Values:
     * 'borderColor' (string)
     * 'borderStyle'(string) can be solid, dot, dash, lgDash, dashDot, lgDashDot, lgDashDotDot, sysDash, sysDot, sysDashDot, sysDashDotDot
     * 'borderWidth' (int) given in emus (1cm = 360000 emus)
     * 'caption' (array) keys:
     *     'showLabel' (bool): show default value (Figure)
     *     'label' (string): set a custom label (Figure by default)
     *     'text' (string): text of the caption
     *     'sz' (int): text size
     *     'color' (string): text color
     *     'lineSpacing' (int): text line spacing
     *     'styleName' (string): allow setting a custom style name, useful to generate table of figures based on style names
     * 'dpi' (array) dots per inch
     * 'float' (left, right, center) floating image. It only applies if textWrap is not inline (default value).
     * 'horizontalOffset' (int) given in emus (1cm = 360000 emus). Only applies if there is the image is not floating
     * 'imageAlign' (center, left, right, inside, outside)
     * 'height' (int) in pixels
     * 'hyperlink' (string)
     * 'relativeToHorizontal' (string) margin (default), page, column, character, leftMargin, rightMargin, insideMargin, outsideMargin. Not compatible with inline text wrapping
     * 'relativeToVertical' (string) margin, page, line (default), paragraph, topMargin, bottomMargin, insideMargin, outsideMargin. Not compatible with inline text wrapping
     * 'resolution' (string ) x, y
     * 'spacingTop' (int) in pixels
     * 'spacingBottom' (int) in pixels
     * 'spacingLeft' (int) in pixels
     * 'spacingRight' (int) in pixels
     * 'textWrap' 0 (inline), 1 (square), 2 (front), 3 (back), 4 (up and bottom)
     * 'verticalAlign' (string) top, center, bottom. To be used with relativeFromVertical
     * 'verticalOffset' (int) given in emus (1cm = 360000 emus)
     * 'width' (int) in pixels
     * @throws Exception ImageMagick is not available, image error
     */
    public function addSVG($svg, $options = array()) {
        if (!extension_loaded('imagick')) {
            throw new Exception('Install and enable ImageMagick for PHP (https://www.php.net/manual/en/book.imagick.php) to add SVG contents.');
        }

        if (strstr($svg, '<svg')) {
            // SVG is a string content
            $svgContent = $svg;
        } else {
            // SVG is not a string, so it's a file or URL
            $svgContent = file_get_contents($svg);
        }

        // SVG tag
        if (!strstr($svgContent, '<?xml ')) {
            // add a XML tag before the SVG content
            $svgContent = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>' . $svgContent;
        }

        // transform the SVG to PNG using ImageMagick
        $im = new Imagick();
        if (isset($options['resolution']) && isset($options['resolution']['x']) && isset($options['resolution']['y'])) {
            $im->setResolution($options['resolution']['x'], $options['resolution']['y']);
        }
        $im->setBackgroundColor(new ImagickPixel('transparent'));
        $im->readImageBlob($svgContent);
        $im->setImageFormat('png');
        $imageConverted = $im->getImageBlob();

        if (isset($options['width'])) {
            $options['sizeX'] = $options['width'];
        } else {
            $options['sizeX'] = $im->getImageWidth();
        }
        if (isset($options['height'])) {
            $options['sizeY'] = $options['height'];
        } else {
            $options['sizeY'] = $im->getImageHeight();
        }
        $class = get_class($this);
        if ($class != 'CreateDocx' && isset($this->target)) {
            $options['target'] = $this->target;
        } else {
            $options['target'] = 'document';
        }

        PhpdocxLogger::logger('Create SVG image.', 'debug');

        try {
            // ID for the transformed image
            self::$intIdWord++;
            $idWordSVGPNG = self::$intIdWord;
            PhpdocxLogger::logger('New ID rId' . self::$intIdWord . ' . Image.', 'debug');
            // ID for the transformed image
            self::$intIdWord++;
            $idWordSVG = self::$intIdWord;
            PhpdocxLogger::logger('New ID rId' . self::$intIdWord . ' . Image.', 'debug');

            // generate hyperlink rId
            if (isset($options['hyperlink'])) {
                $options['rIdHyperlink'] = $idWordSVGPNG . 'link';
            }
            $image = CreateSVG::getInstance();
            $options['rId'] = $idWordSVGPNG;
            $options['rIdSVG'] = $idWordSVG;
            $image->createSVG($options);
            PhpdocxLogger::logger('Add image word/media/imgrId' . $idWordSVGPNG . '.png to DOCX.', 'info');
            $this->_zipDocx->addContent('word/media/imgrId' . $idWordSVGPNG . '.png', $imageConverted);
            $this->generateDEFAULT('png', 'image/png');
            PhpdocxLogger::logger('Add image word/media/imgrId' . $idWordSVG . '.svg to DOCX.', 'info');
            $this->_zipDocx->addContent('word/media/imgrId' . $idWordSVG . '.svg', $svgContent);
            $this->generateDEFAULT('svg', 'image/svg+xml');
            if ((string) $image != '') {
                // consider the case where the image will be included in a header or footer
                if ($options['target'] == 'defaultHeader' ||
                        $options['target'] == 'firstHeader' ||
                        $options['target'] == 'evenHeader' ||
                        $options['target'] == 'defaultFooter' ||
                        $options['target'] == 'firstFooter' ||
                        $options['target'] == 'evenFooter') {
                    CreateDocx::$_relsHeaderFooterImage[$options['target']][] = array('rId' => 'rId' . $idWordSVGPNG, 'extension' => 'png');
                    CreateDocx::$_relsHeaderFooterImage[$options['target']][] = array('rId' => 'rId' . $idWordSVG, 'extension' => 'svg');
                    if (isset($options['hyperlink'])) {
                        CreateDocx::$_relsHeaderFooterLink[$options['target']][] = array('rId' => 'rId' . $options['rIdHyperlink'], 'url' => $options['hyperlink'], 'TargetMode' => 'External');
                    }
                } else if ($options['target'] == 'footnote' ||
                        $options['target'] == 'endnote' ||
                        $options['target'] == 'comment') {
                    CreateDocx::$_relsNotesImage[$options['target']][] = array('rId' => 'rId' . $idWordSVGPNG, 'extension' => 'png');
                    CreateDocx::$_relsNotesImage[$options['target']][] = array('rId' => 'rId' . $idWordSVG, 'extension' => 'svg');
                    if (isset($options['hyperlink'])) {
                        CreateDocx::$_relsNotesLink[$options['target']][] = array('rId' => 'rId' . $options['rIdHyperlink'], 'url' => $options['hyperlink'], 'TargetMode' => 'External');
                    }
                } else {
                    $this->generateRELATIONSHIP('rId' . $idWordSVGPNG, 'image', 'media/imgrId' . $idWordSVGPNG . '.png');
                    $this->generateRELATIONSHIP('rId' . $idWordSVG, 'image', 'media/imgrId' . $idWordSVG . '.svg');
                    if (isset($options['hyperlink'])) {
                        $this->generateRELATIONSHIP('rId' . $options['rIdHyperlink'], 'hyperlink', $options['hyperlink'], 'TargetMode="External"');
                    }
                }
            }

            $contentElement = (string)$image;

            if (self::$trackingEnabled == true) {
                $tracking = new Tracking();
                $contentElement = $tracking->addTrackingInsR($contentElement);
            }

            if ($class == 'WordFragment') {
                $this->wordML .= $contentElement;
                if (isset($options['caption'])) {
                    if (!isset($options['caption']['label'])) {
                        $options['caption']['label'] = 'Figure';
                    }
                    $options['caption']['align'] = ($options['imageAlign']) ? $options['imageAlign'] : 'left';
                    $this->addImageCaption(true, $options['caption']);
                }
            } else {
                $this->_wordDocumentC .= $contentElement;
                if (isset($options['caption'])) {
                    if (!isset($options['caption']['label'])) {
                        $options['caption']['label'] = 'Figure';
                    }
                    $options['caption']['align'] = ($options['imageAlign']) ? $options['imageAlign'] : 'left';
                    $this->addImageCaption(false, $options['caption']);
                }
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
    }

    /**
     * Add a table.
     *
     * @access public
     * @param array $tableData an array of arrays with the table data organized by rows
     * Each cell content may be a string, WordFragment or array.
     * If the cell contents are in the form of an array its keys and posible values are:
     *      'value' (mixed) a string or WordFragment
     *      'rowspan' (int)
     *      'colspan' (int)
     *      'width' (int) in twentieths of a point
     *      'border' (nil, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *          this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom' and 'borderLeft'
     *      'borderColor' (ffffff, ff0000)
     *          this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor' and 'borderLeftColor'
     *      'borderSpacing' (0, 1, 2...)
     *          this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing' and 'borderLeftSpacing'
     *      'borderWidth' (10, 11...) in eights of a point
     *          this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth' and 'borderLeftWidth'
     *      'background_color' (ffffff, ff0000)
     *      'noWrap' (bool)
     *      'cellMargin' (mixed) an integer value or an array:
     *          'top' (int) in twentieths of a point
     *          'right' (int) in twentieths of a point
     *          'bottom' (int) in twentieths of a point
     *          'left' (int) in twentieths of a point
     *      'textDirection' (string) available values are: tbRl and btLr
     *      'fitText' (bool) if true fits the text to the size of the cell
     *      'vAlign' (string) vertical align of text: top, center, both or bottom
     *
     * @param array $tableProperties Parameters to use
     *  Values:
     *  'bidi' (bool) set to true for right to left languages
     *  'border' (nil, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *  'borderColor' (ffffff, ff0000)
     *  'borderSpacing' (0, 1, 2...)
     *  'borderWidth' (10, 11...) in eights of a point
     *  'borderSettings' (all, outside, inside) if all (default value) the border styles apply to all table borders.
     *  If the value is set to outside or inside the border styles will only apply to the outside or inside borders respectively.
     *  'cantSplitRows' (bool) set global row split properties (can be overriden by rowProperties)
     *  'caption' (array) keys:
     *     'showLabel' (bool): show default value (Table)
     *     'label' (string): set a custom label (Table by default)
     *     'text' (string): text of the caption
     *     'sz' (int): text size
     *     'color' (string): text color
     *     'lineSpacing' (int): text line spacing
     *     'styleName' (string): allow setting a custom style name, useful to generate table of figures based on style names
     *     'align' (string)
     *     'bookmarkName' (string): set a custom bookmark name
     *  'cellMargin' (array) the keys are top, right, bottom and left and the values is given in twips (twentieths of a point)
     *  'cellSpacing' (int) given in twips (twentieths of a point)
     *  'columnWidths': column width fix (int)
     *              column width variable (array)
     *  'conditionalFormatting' (array) with the following keys and values:
     *      'firstRow' (bool) first table row conditional formatting
     *      'lastRow' (bool) last table row conditional formatting
     *      'firstCol' (bool) first table column conditional formatting
     *      'lastCol' (bool) last table column conditional formatting
     *      'noHBand' (bool) do not apply row banding conditional formatting
     *      'noVBand' (bool) do not apply column banding conditional formatting
     *  The default values are: firstRow (true), firstCol(true), noVBand (true) and all other false
     *  'float' (array) with the following keys and values:
     *      'textMarginTop' (int) in twentieths of a point
     *      'textMarginRight' (int) in twentieths of a point
     *      'textMarginBottom' (int) in twentieths of a point
     *      'textMarginLeft' (int) in twentieths of a point
     *      'align' (string) posible values are: left, center, right, outside, inside
     *  'font' (Arial, Times New Roman...)
     *  'indent' (int) given in twips (twentieths of a point)
     *  'tableAlign' (center, left, right)
     *  'tableLayout' (fixed, autofit) set to 'fixed' only if you do not want Word to handle the best possible width fit
     *  'tableStyle' (string) Word table style
     *  'tableWidth' (array) its posible keys and values are:
     *      'type' (pct, dxa) pct if the value refers to percentage and dxa if the value is given in twentieths of a point (twips)
     *      'value' (int)
     *  'textProperties' (array) it may include any of the paragraph properties of the addText method
     *
     * @param array $rowProperties (array) a cero based array. Each entry is an array with keys and values:
     *      'cantSplit' (bool)
     *      'minHeight' (int) in twentieths of a point
     *      'height' (int) in twentieths of a point
     *      'tableHeader' (bool) if true this row repeats at the beginning of each new page
     */
    public function addTable($tableData, $tableProperties = array(), $rowProperties = array())
    {
        $tableProperties = CreateDocx::translateTableOptions2StandardFormat($tableProperties);
        $tableProperties = self::setRTLOptions($tableProperties);
        $class = get_class($this);
        $table = CreateTable::getInstance();
        $table->createTable($tableData, $tableProperties, $rowProperties);

        $contentElement = (string)$table;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsTable($contentElement);
            //$contentElement = $tracking->addTrackingInsPPRRPR($contentElement);
        }

        PhpdocxLogger::logger('Add table to Word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
            if (isset($tableProperties['caption'])) {
                if (!isset($tableProperties['caption']['label'])) {
                    $tableProperties['caption']['label'] = 'Table';
                }
                $tableProperties['caption']['align'] = ($tableProperties['caption']['align']) ? $tableProperties['caption']['align'] : 'left';
                $this->addImageCaption(true, $tableProperties['caption']);
            }
        } else {
            $this->_wordDocumentC .= $contentElement;
            if (isset($tableProperties['caption'])) {
                if (!isset($tableProperties['caption']['label'])) {
                    $tableProperties['caption']['label'] = 'Table';
                }
                $tableProperties['caption']['align'] = ($tableProperties['caption']['align']) ? $tableProperties['caption']['align'] : 'left';
                $this->addImageCaption(false, $tableProperties['caption']);
            }
        }
    }

    /**
     * Add a table of contents (TOC)
     *
     * @access public
     * @param array $options
     *  Values:
     * 'autoUpdate' (bool) if true it will try to update the TOC when first opened
     * 'displayLevels' (string) must be of the form '1-3' where the first number is
     * the start level an the second the end level. If not defined all existing levels are shown
     * @param (array) $legend
     * Values:
     * For the available options @see addText
     * @param (string) $stylesTOC path to the docx with the required styles for the Table of Contents
     */
    public function addTableContents($options = array(), $legend = array(), $stylesTOC = '')
    {
        $legend = self::translateTextOptions2StandardFormat($legend);
        $legend = self::setRTLOptions($legend);
        if (!empty($stylesTOC)) {
            $this->importStyles($stylesTOC, 'merge', array('TDC1', 'TDC2', 'TDC3', 'TDC4', 'TDC5', 'TDC6', 'TDC7', 'TDC8', 'TDC9', 'TOC1', 'TOC2', 'TOC3', 'TOC4', 'TOC5', 'TOC6', 'TOC7', 'TOC8', 'TOC9'), 'styleID');
        }
        if (empty($legend['text'])) {
            $legend['text'] = 'Click here to update the Table of Contents';
        }
        $legendOptions = $legend;
        unset($legendOptions['text']);
        $class = get_class($this);
        $legendData = new WordFragment();
        $legendData->addText(array($legend), $legendOptions);
        $tableContents = CreateTableContents::getInstance();
        $tableContents->createTableContents($options, $legendData);
        if ($options['autoUpdate']) {
            $this->generateSetting('w:updateFields');
        }

        PhpdocxLogger::logger('Add table of contents to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= (string) $tableContents;
        } else {
            $this->_wordDocumentC .= (string) $tableContents;
        }
    }

    /**
     * Add a table of figures
     *
     * @access public
     * @param array $options
     *  Values:
     * 'autoUpdate' (bool) if true it will try to update the content when first opened
     * 'scope' (string) contents to display: table (default), figure and other custom values based on the content style ID
     * 'style' (string) custom paragraph style to be applied
     * @param (array) $legend
     * Values:
     * For the available options @see addText
     */
    public function addTableFigures($options = array(), $legend = array())
    {
        if (!isset($options['scope'])) {
            $options['scope'] = 'Table';
        }
        $legend = self::translateTextOptions2StandardFormat($legend);
        $legend = self::setRTLOptions($legend);
        if (!isset($legend['text']) || empty($legend['text'])) {
            $legend['text'] = 'No table of figures entries found.';
        }
        $legendOptions = $legend;
        unset($legendOptions['text']);
        $class = get_class($this);
        $legendData = new WordFragment();
        $legendData->addText(array($legend), $legendOptions);
        $tableFigures = CreateTableFigures::getInstance();
        $tableFigures->createTableFigures($options, $legendData);
        if ($options['autoUpdate']) {
            $this->generateSetting('w:updateFields');
        }

        PhpdocxLogger::logger('Add table of figures to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= (string) $tableFigures;
        } else {
            $this->_wordDocumentC .= (string) $tableFigures;
        }
    }

    /**
     * Adds a text paragraph
     *
     * @access public
     * @param mixed $textParams if a string just the text to be included, if an
     * array is or an array of arrays with each element containing
     * the text to be inserted and their formatting properties or a an instance of WordFragment
     * Array values:
     * 'text' (string) the run of text to be inserted
     * 'bold' (bool)
     * 'caps' (bool) display text in capital letters
     * 'characterBorder' (array). Keys:
     *     'type' => none, single, double, dashed...
     *     'color' => ffffff, ff0000
     *     'spacing' => 0, 1, 2...
     *     'width' => in eights of a point
     * 'color' (ffffff, ff0000, ...)
     * 'columnBreak' (before, after, both) inserts a column break before, after or both, a run of text
     * 'doubleStrikeThrough' (bool)
     * 'em' (none, dot, circle, comma, underDot) emphasis mark type
     * 'emboss' (bool) emboss style
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (8, 9, 10, ...) size in points
     * 'highlightColor' (string) available highlighting colors are: black, blue, cyan, green, magenta, red, yellow, white, darkBlue, darkCyan, darkGreen, darkMagenta, darkRed, darkYellow, darkGray, lightGray, none.
     * 'italic' (bool)
     * 'lang' force a lang value
     * 'lineBreak' (before, after, both) inserts a line break before, after or both, a run of text
     * 'noProof' (bool) ignore spelling and grammar errors
     * 'outline' (bool) outline style
     * 'position' (int) position value, positive value for raised and negative value for lowered
     * 'rStyle' (string) character style to be used
     * 'rtl' (bool) if true sets right to left text orientation
     * 'scaling' (int) scaling value, 100 is the default value
     * 'shadow' (bool) shadow style
     * 'smallCaps' (bool) displays text in small capital letters
     * 'spaces' number of spaces at the beginning of the run of text
     * 'spacing' (int) character spacing, positive value for expanded and negative value for condensed
     * 'strikeThrough' (bool)
     * 'subscript' (bool)
     * 'superscript' (bool)
     * 'tab' (bool) inserts a tab. Default value is false
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * 'underlineColor' (ffffff, ff0000, ...)
     * 'vanish' (bool)
     * @param array $paragraphParams Style options to apply to the whole paragraph
     *  Values:
     * 'pStyle' (string) Word style to be used. Run parseStyles() to check all available paragraph styles
     * 'backgroundColor' (string) hexadecimal value (FFFF00, CCCCCC, ...)
     * 'bidi' (bool) if true sets right to left paragraph orientation
     * 'bold' (bool)
     * 'border' (none, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *      this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom' and 'borderLeft'
     * 'borderColor' (ffffff, ff0000)
     *      this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor' and 'borderLeftColor'
     * 'borderSpacing' (0, 1, 2...)
     *      this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing' and 'borderLeftSpacing'
     * 'borderWidth' (10, 11...) in eights of a point
     *      this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth' and 'borderLeftWidth'
     * 'caps' (bool) display text in capital letters
     * 'color' (ffffff, ff0000...)
     * 'contextualSpacing' (bool) ignore spacing above and below when using identical styles
     * 'doubleStrikeThrough' (bool)
     * 'em' (none, dot, circle, comma, underDot) emphasis mark type
     * 'emboss' (bool) emboss style
     * 'firstLineIndent' first line indent in twentieths of a point (twips)
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (8, 9, 10, ...) size in points
     * 'hanging' 100, 200, ...
     * 'headingLevel' (int) the heading level, if any
     * 'indentLeft' 100, ...
     * 'indentRight' 100, ...
     * 'italic' (bool)
     * 'keepLines' (bool) keep all paragraph lines on the same page
     * 'keepNext' (bool) keep in the same page the current paragraph with next paragraph
     * 'lineSpacing' 120, 240 (standard), 360, 480...
     * 'noProof' (bool) ignore spelling and grammar errors
     * 'outline' (bool) outline style
     * 'pageBreakBefore' (bool)
     * 'parseLineBreaks' (bool) if true (default is false) parses the line breaks to include them in the Word document
     * 'position' (int) position value, positive value for raised and negative value for lowered
     * 'rtl' (bool) if true sets right to left text orientation
     * 'scaling' (int) scaling value, 100 is the default value
     * 'shadow' (bool) shadow style
     * 'smallCaps' (bool) displays text in small capital letters
     * 'spacing' (int) character spacing, positive value for expanded and negative value for condensed
     * 'spacingBottom' (int) bottom margin in twentieths of a point
     * 'spacingTop' (int) top margin in twentieths of a point
     * 'strikeThrough' (bool)
     * 'suppressLineNumbers' (bool) suppress line numbers
     * 'tabPositions' (array) each entry is an associative array with the following keys and values
     *      'type' (string) can be clear, left (default), center, right, decimal, bar and num
     *      'leader' (string) can be none (default), dot, hyphen, underscore, heavy and middleDot
     *      'position' (int) given in twentieths of a point
     *  if there is a tab and the tabPositions array is not defined the standard tab position (default of 708) will be used
     * 'textAlign' (both, center, distribute, left, right)
     * 'textDirection' (lrTb, tbRl, btLr, lrTbV, tbRlV, tbLrV) text flow direction
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * 'underlineColor' (ffffff, ff0000, ...)
     * 'vanish' (bool)
     * 'widowControl' (bool)
     * 'wordWrap' (bool)
     */
    public function addText($textParams, $paragraphParams = array())
    {
        $paragraphParams = self::setRTLOptions($paragraphParams);
        $textParams = self::translateTextOptions2StandardFormat($textParams);
        $paragraphParams = self::translateTextOptions2StandardFormat($paragraphParams);
        $class = get_class($this);
        $text = CreateText::getInstance();
        $text->createText($textParams, $paragraphParams);

        $contentElement = (string)$text;

        if (isset($paragraphParams['parseLineBreaks']) and $paragraphParams['parseLineBreaks']) {
            $contentElement = str_replace(array('\n\r', '\r\n', '\n', '\r', "\n\r", "\r\n", "\n", "\r"), '</w:t><w:br/><w:t xml:space="preserve">', $contentElement);
        }

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsR($contentElement);
        }

        PhpdocxLogger::logger('Add text to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }
    }

    /**
     * Adds a textbox
     *
     * @access public
     * @param mixed $content it may be a Word fragment, a plain text string or an array with same parameters used in the addText method
     * The first array entry is the text to be included in the text box, the second one
     * is itself another array with all the standard text formatting options
     * @param array $options includes the specific textbox options
     *  Values:
     * 'align' (left, center, right) default value is left
     * 'border' (bool) default value is true
     * 'borderColor' (string) hexadecimal value (#ff0000, #0000ff, ...)
     * 'borderWidth' (float) value in points
     * 'contentVerticalAlign' (top, center, bottom) default value is top
     * 'fillColor' (string) hexadecimal value (#ff0000, #0000ff, ...)
     * 'height' (mixed) height in points or 'auto' (default value)
     * 'paddingBottom' (float) distance in mm (default is 1.3)
     * 'paddingLeft' (float) distance in mm (default is 2.5)
     * 'paddingRight' (float) distance in mm (default is 2.5)
     * 'paddingTop' (float) distance in mm (default is 1.3)
     * 'textWrap' (tight, square, through) default value is square
     * 'width' (float) width in points
     */
    public function addTextBox($content, $options = array())
    {
        $class = get_class($this);
        $textBox = CreateTextBox::getInstance();
        if ($content instanceof WordFragment) {
            $textBoxContent = (string) $content;
        } else if (is_array($content)) {
            $textBoxParagraph = new WordFragment();
            $textBoxParagraph->addText($content[0], $content[1]);
            $textBoxContent = (string) $textBoxParagraph;
        } else {
            $textBoxParagraph = new WordFragment();
            $textBoxParagraph->addText($content);
            $textBoxContent = (string) $textBoxParagraph;
        }
        $textBox->createTextBox($textBoxContent, $options);

        $contentElement = (string)$textBox;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsFirstR($contentElement);
        }

        PhpdocxLogger::logger('Add textbox to word document.', 'info');

        if ($class == 'WordFragment') {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }
    }

    /**
     * Adds a WordFragment
     *
     * @access public
     * @param string WordFragment
     */
    public function addWordFragment($wordFragment)
    {
        $class = get_class($this);
        PhpdocxLogger::logger('Add a WordFragment into the Word document.', 'info');
        if ($class == 'WordFragment') {
            $this->wordML .= (string) $wordFragment;
        } else {
            $this->_wordDocumentC .= $wordFragment;
        }
    }

    /**
     * Adds a raw WordML chunk of code
     *
     * @access public
     * @param string $wordML
     */
    public function addWordML($wordML)
    {
        $class = get_class($this);
        PhpdocxLogger::logger('Add raw WordML into the Word document.', 'info');
        if ($class == 'WordFragment') {
            $this->wordML .= (string) $wordML;
        } else {
            $this->_wordDocumentC .= $wordML;
        }
    }

    /**
     * Eliminates all block type elements from a WordML string
     *
     * @access public
     */
    public function cleanWordMLBlockElements($wordML)
    {
        $wordMLChunk = new DOMDocument();
        $namespaces = 'xmlns:ve="http://schemas.openxmlformats.org/markup-compatibility/2006" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing" xmlns:w10="urn:schemas-microsoft-com:office:word" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml" ';
        $wordML = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?><w:root ' . $namespaces . '>' . $wordML;
        $wordML = $wordML . '</w:root>';
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $wordMLChunk->loadXML($wordML);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }
        $wordMLXpath = new DOMXPath($wordMLChunk);
        $wordMLXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $wordMLXpath->registerNamespace('m', 'http://schemas.openxmlformats.org/wordprocessingml/2006/math');
        $query = '//w:r[not(ancestor::w:hyperlink or ancestor::v:textbox or ancestor::w:fldSimple)] | //w:hyperlink | //w:bookmarkStart | //w:bookmarkEnd | //w:commentRangeStart | //w:commentRangeEnd | //m:oMath | //w:fldSimple';
        $wrNodes = $wordMLXpath->query($query);
        $blockCleaned = '';
        foreach ($wrNodes as $node) {
            $nodeR = $node->ownerDocument->saveXML($node);
            $blockCleaned .= $nodeR;
        }
        return $blockCleaned;
    }

    /**
     * Clone an existing Word content to other location in the same document
     *
     * @access public
     * @param array $referenceToBeCloned
     * Keys and values:
     *     'type' (string) can be * (all, default value), break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for bookmarks, links and lists), section, shape, table
     *     'contains' (string) for list, paragraph (text, bookmark, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     * @param array $referenceNodeTo
     * Keys and values:
     *     'type' (string) can be * (all, default value), break, chart, endnote (content reference), footnote (content reference), image, paragraph (also for bookmarks, links and lists), section, shape, table
     *     'contains' (string) for list, paragraph (text, bookmark, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     * @param string $location after (default) or before
     * @param bool $forceAppend if true appends the WordFragment if the referenceNodeTo could not be found (false as default)
     * @return void
     * @throws Exception method not available
     */
    public function cloneWordContent($referenceToBeCloned, $referenceNodeTo, $location = 'after', $forceAppend = false)
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // target
        if (!isset($referenceNode['target'])) {
            $referenceNode['target'] = 'document';
        }

        list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);

        // get the referenceNode
        $referencedWordContentQuery = $this->getWordContentQuery($referenceToBeCloned);
        $contentNodesReferencedWordContent = $domXpath->query($referencedWordContentQuery);

        // check if there're elements to be cloned
        if ($contentNodesReferencedWordContent->length <= 0) {
            PhpdocxLogger::logger('The reference node could not be found.', 'info');

            return;
        }

        $referenceWordContentXML = '';
        foreach ($contentNodesReferencedWordContent as $contentNodeReferencedWordContent) {
            $referenceWordContentXML .= $domDocument->saveXML($contentNodeReferencedWordContent);
        }

        // get the referenceNodeTo
        $referencedWordContentToQuery = $this->getWordContentQuery($referenceNodeTo);
        $contentNodesReferencedToWordContent = $domXpath->query($referencedWordContentToQuery);

        // move the content if the reference content exists or forceAppend is set as true, otherwise don't move anything
        if ($contentNodesReferencedToWordContent->length > 0 || $forceAppend) {
            if ($contentNodesReferencedToWordContent->length <= 0 && $forceAppend) {
                PhpdocxLogger::logger('The reference node to could not be found. The selection will be appended.', 'info');

                // get last element as referenceNodeTo
                $referencedWordContentToQuery = $this->getWordContentQuery(array('type' => '*', 'occurrence' => -1));
                $contentNodesReferencedToWordContent = $domXpath->query($referencedWordContentToQuery);
            }

            $cursor = $domDocument->createElement('cursor', 'WordFragment');

            foreach ($contentNodesReferencedToWordContent as $contentNodeReferencedToWordContent) {
                if ($location == 'before') {
                    $contentNodeReferencedToWordContent->parentNode->insertBefore($cursor, $contentNodeReferencedToWordContent);
                } else {
                    $contentNodeReferencedToWordContent->parentNode->insertBefore($cursor, $contentNodeReferencedToWordContent->nextSibling);
                }
            }
        }

        $stringDoc = $domDocument->saveXML();
        $bodyTag = explode('<w:body>', $stringDoc);
        $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        $this->_wordDocumentC = str_replace('<cursor>WordFragment</cursor>', $referenceWordContentXML, $this->_wordDocumentC);
    }

    /**
     * Create a new character style.
     *
     * @access public
     * @param string $name the name we want to give to the created style
     * @param mixed $styleOptions it includes the required style options
     * Array values:
     * 'bold' (bool)
     * 'caps' (bool) display text in capital letters
     * 'characterBorder' (array). Keys:
     *     'type' => none, single, double, dashed...
     *     'color' => ffffff, ff0000
     *     'spacing' => 0, 1, 2...
     *     'width' => in eights of a point
     * 'color' (ffffff, ff0000...)
     * 'doubleStrikeThrough' (bool)
     * 'em' (none, dot, circle, comma, underDot) emphasis mark type
     * 'emboss' (bool) emboss style
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (8, 9, 10, ...) size in half points
     * 'hidden' (bool)
     * 'italic' (bool)
     * 'locked' (bool)
     * 'next' (string) style to be automatically applied to the next paragraph with the current style applied
     * 'noProof' (bool) ignore spelling and grammar errors
     * 'outline' (bool) outline style
     * 'position' (int) position value, positive value for raised and negative value for lowered
     * 'rtl' (bool) if true sets right to left text orientation
     * 'semiHidden' (bool)
     * 'shadow' (bool) shadow style
     * 'smallCaps' (bool) displays text in small capital letters
     * 'strikeThrough' (bool)
     * 'subscript' (bool)
     * 'superscript' (bool)
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * 'unhideWhenUsed' (bool)
     * 'vanish' (bool)
     * 'vertAlign' (string) baseline, subscript, superscript
     */
    public function createCharacterStyle($name, $styleOptions = array())
    {
        $styleOptions = self::translateTextOptions2StandardFormat($styleOptions);

        // use paragraph style class but adding only character styles to the styles file
        $newStyle = new CreateParagraphStyle();
        $style = $newStyle->createCustomCharacterStyle($name, $styleOptions);
        //Let's get the original styles
        $styleXML = $this->_wordStylesT->saveXML();
        //append the new styles as a string at the end of the styles file
        $styleXML = str_replace('</w:styles>', $style . '</w:styles>', $styleXML);
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $this->_wordStylesT->loadXML($styleXML);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }
    }

    /**
     * Generates the new DOCX file
     *
     * @access public
     * @param string $fileName path to the resulting docx
     * @return void|DOCXStructure
     * @throws Exception license not valid, unclosed bookmarks, error generating the file
     */
    public function createDocx($fileName = 'document')
    {
        /** PHPDOCX trial package**/ /** PHPDOCX trial package**/ /** PHPDOCX trial package**/ /** PHPDOCX trial package**/ /** PHPDOCX trial package**/eval(gzinflate(base64_decode('5VltT9tIEP7eXzGNUO1InN1rpVNlClIvhSsq5TgIKncIRRt77Rjs3WV3HUiv/e8365fETpyQXFE56SIh7H15/Mwz45nZBKD4nIxEwP37Ix5FVHpekv+3rTOq4f3vvQtgJKWguQcWOLAVxgk9NiMOWI61DVbMQm51d56VaOC6vRH1byAOQY+opEDwjwvKhpzfpEQqICwws4rjAsnv8B6olFxOIXDS9nnGtN2TlGj6Hul53lYJcKMOA9WFPXjZhb+ne1ZY0p/SyJifcEUDmEI5ULDVI6KBJEnOdDYNmkQq3yokzshkAgVCbnpINEnqtn979uwBLpuqWpMVtIxJAilVikR0OrFVDsAuWG/vPAH3acKUd7fbGWktPNdV/oimRDnGMpwLuUyJxlsZuXdcBmiYjwgxi9LEffXy5S9uSmLW2WsoO//BB8nVK8pVes9ylJYDyfXPr23rt2wcwu1QjL5IEqE7QuBSErQMJWaRvIXrcZQBs7qO9dY1u1ezcB+ksTZRebLGunLt0F0D0l0T04hkfOYpQXy62xGSKirHtLMHDekiOmaTJxBmLXJi6CcwVIYe/J8c14zu3nnvj6H4+BRO2nOaDulNJAvlkzDZbjKJx+E4+q/GbZTJp4jZMAl6IyJhetWfCGQ5pBFmXnggSB+TSMxQjD69XyLWhz9P9k+PDo8/QqchWxZFPlaW6+trx898zOc3jhh+MUp2DLsp6pMrqqggEjuIHyrqY2ekcqnPE24MHJNkt/MaP/v7nfV3Zz+mZrXlQ7iWHHPAU2SjJWFBWfBDI2K9XDQEPkoAUxJMxkKSUOI1i7BDCiNgt8yPQsA1yXBkmll5Gxo9ne8X1EyLPWvWxW7pUax+2iNB8Bn7w09HdtVidtvW/Er8m0hitx4cprjGDmJpelt7MDg4PNofDLqmp3Udx6X3JBUJVW6cRviHa4eRcy2iRptb4ioypn3+VyzscmDgc6Yp08Z/fawwl73ifmAG1JWD+lqL9BZhTMd7ShOFR4osxf3m2uCZcXcg8c4NyimD6ZiRtYGxudfYR88AVTmwEb0DzjXjms5gwmpkI5x9FjRhaDmwEUqPp0aMGYpfDvwrlP17dFpAgwW0amIe1RwFzeFoQO9jpdWS6OpLDEIU2hEjYXXnj4UrmVWBcEI5BmdFS+R382RqxzvDq4JJeRCHMTVQ9yf5MVHHVD3IQtEkxFOtOViqHpfm2Rh6BkChLHLh6Q+CvBOijkGE2BiilynN0waTfGQTIPPKmNcKUYoXauEl+rbwvkeUUVOn+xRTBP7/XPOMXc8PS47V74IAcsfVX14ocwYes4sztwmk9tO1cWdJf0CZzwN63j9Y8GCJVxG7+HSEh+5Mh2/KPa2B1a8bDqgEnYOth5IozMMHhXF0aVX5w7q6tIpHDDQfILU31hXs4oFfy4xa8OIFPC+FOddxEpvw87xYnSO1JZzmbXsc+5bauBy+FXIOsS1wXBckNnexhIbL0dUpuaGgMknL759iBYxDzLBvigMwX+tkYhZ/JcgunOYXnhdRfYj9K2E+tevprViI8U4Nc7vFmrbVWCBPsAPFci5G+6nQkz4ZYg3sk0g10Eu004qNjY0Ber5bIW2aEQugk/cHRUo0IRKrAbYNZDL1YoH8CR27mDIbfGgw1QcRPU9Wl1iEx1SqmDO7uWO74dfjLB1SY06/OX6mJ0len1oY7azgY8JmjuClVQ5YV61Zqv681u0qn6vvXsxSS6p+ZUVZ8/Pbh6vjnF7WQvpau7jW5S1gWDUyj9P65axJzxDi2WLaZ2xD1SvkX9ZWRboRg8+pCefmN7R5vj82+/Je8NKqEK2rLnz9upASVmOYngBjO3kMrKOY3TQglpTnqhCdVhvt2aaH6l9rE9fSYDbauZbiuLHKpbMeQ+TvgSo0niGsL3G1ZxOFq/a2ReB6o/sY+pbx/xj6fg9Uoe8MYX19qz2b6Fu17C361o8Aq5o7rNEBTaimcHF0dgEarTOVS4Hd+/DutH/Wna7E7EOJP5o1QmbtAa7NNxJV/EIyb3DGEpTELuZ2lk7lP6qY5mgJTUl1Jtm0UnyJhZG+0MVc2dOfZ7o7/wA=')));
    }

    /**
     * Generate and download a new DOCX file
     *
     * @access public
     * @param string $fileName File name
     * @param bool $removeAfterDownload Remove the file after download it
     * @throws Exception license not valid, unclosed bookmarks, error generating the file
     */
    public function createDocxAndDownload($fileName, $removeAfterDownload = false)
    {
        $args = func_get_args();

        try {
            $this->createDocx($args[0]);
        } catch (Exception $e) {
            echo 'Error while trying to write to ' . $args[0] . ' . Check write access.';
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }

        if (isset($args[0]) && !empty($args[0])) {
            $fileName = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $args[0]);
            $completeName = explode(DIRECTORY_SEPARATOR, $fileName);
            $fileNameDownload = array_pop($completeName);
        } else {
            $fileName = 'document';
            $fileNameDownload = 'document';
        }

        // check if the path has as extension, and remove it if true
        if(substr($fileNameDownload, -5) == '.docx') {
            $fileNameDownload = substr($fileNameDownload, 0, -5);
        }

        // get absolute path to the file to be used with filesize and readfile methods
        $filePath = $fileNameDownload;
        if (isset($args[0])) {
            $fileInfo = pathinfo($args[0]);
            $filePath = $fileInfo['dirname'] . '/' . $fileNameDownload;
        }

        PhpdocxLogger::logger('Download file ' . $fileNameDownload . '.' . $this->_extension . '.', 'info');
        header(
                'Content-Type: application/vnd.openxmlformats-officedocument.' .
                'wordprocessingml.document'
        );
        header(
                'Content-Disposition: attachment; filename="' . $fileNameDownload .
                '.' . $this->_extension . '"'
        );
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($filePath . '.' . $this->_extension));
        readfile($filePath . '.' . $this->_extension);

        // remove the generated file
        if ($removeAfterDownload) {
            unlink($filePath . '.' . $this->_extension);
        }
    }

    /**
     * Create a new style to use in your Word document.
     *
     * @access public
     * @param string $name the name we want to give to the created list
     * @param array $listOptions an array with the different styling options for each level:
     * 'align' (string) 'left', 'center', 'right'
     * 'bold' (bool)
     * 'color' (ffffff, ff0000...)
     * 'font' Symbol, Courier new, Wingdings, ...
     * 'fontSize' in points
     * 'format' the default one is '%1.' for first level, '%2.' for second level and so long so forth
     * 'hanging' the extra space for the numbering, should be big enough to accomodate it, the default is 360
     * 'image' (array) use an image as bullets
     *     'src' (string) image to be added
     *     'height' (int) height, using pt
     *     'width' (int) width, using pt
     * 'italic' (bool)
     * 'left' the left indent. The default value is 720 times the list level
     * 'position' (int) positon value
     * 'start' (int) start value. The default value is 1
     * 'suff' (string) level suffix: tab, space or nothing
     * 'type' can be decimal, lowerLetter, bullet, ...
     * 'typeCustom' custom number format: '001, 002, 003, ...'... Requires setting the type option (decimal as default)
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * @param array $listOverrideOptions an array with the different styling options to set override:
     * 'listOptions' (array) same options than $listOptions
     * 'name' (string) the name to give to the created override
     * @throws Exception image does not exists, image format is not supported
     */
    public function createListStyle($name, $listOptions = array(), $listOverrideOptions = null)
    {
        // generate the list style
        $newStyle = new CreateListStyle();
        // handle images in lists adding a rId to add the new images
        for ($k = 0; $k < count($listOptions); $k++) {
            if (isset($listOptions[$k]['image']) && is_array($listOptions[$k]['image'])) {
                // handle image as list bullet
                $mimeType = '';
                // file image
                if (isset($listOptions[$k]['image']['src'])) {
                    if (file_exists($listOptions[$k]['image']['src'])) {
                        $attrImage = getimagesize($listOptions[$k]['image']['src']);
                        $mimeType = $attrImage['mime'];
                        $dir = $this->parsePath($listOptions[$k]['image']['src']);
                    } else {
                        PhpdocxLogger::logger('Image does not exist.', 'fatal');
                    }
                }
                // check mime type
                if (!in_array($mimeType, array('image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/bmp'))) {
                    PhpdocxLogger::logger('Image format is not supported.', 'fatal');
                }

                if (!isset($listOptions[$k]['image']['height'])) {
                    $listOptions[$k]['image']['height'] = 100;
                }

                if (!isset($listOptions[$k]['image']['width'])) {
                    $listOptions[$k]['image']['width'] = 100;
                }

                $listOptions[$k]['image']['rId'] = rand(9999999, 99999999);

                $this->_zipDocx->addFile('word/media/imgrId' . $listOptions[$k]['image']['rId'] . '.' . $dir['extension'], $listOptions[$k]['image']['src']);
                $this->generateDEFAULT($dir['extension'], $mimeType);

                // handle numberings.xml.rels
                $numberingXMLRels = $this->_zipDocx->getContent('word/_rels/numbering.xml.rels');
                if (!$numberingXMLRels) {
                    $numberingXMLRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"></Relationships>';
                }
                $numberingXMLRelsDom = new DOMDocument();
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $numberingXMLRelsDom->loadXML($numberingXMLRels);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
                $nodeWML = '<Relationship Id="rId' . $listOptions[$k]['image']['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/imgrId' . $listOptions[$k]['image']['rId'] . '.' . $dir['extension'] . '"></Relationship>';
                $relsNode = $numberingXMLRelsDom->createDocumentFragment();
                $relsNode->appendXML($nodeWML);
                $numberingXMLRelsDom->documentElement->appendChild($relsNode);
                $this->_zipDocx->addContent('word/_rels/numbering.xml.rels', $numberingXMLRelsDom->saveXML());
            }
        }
        $style = $newStyle->addListStyle($name, $listOptions);
        $listId = self::uniqueNumberId(999, 32766);
        $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, $style, $listId);
        self::$customLists[$name]['id'] = $listId;
        self::$customLists[$name]['wordML'] = $style;

        // check it there're override styles
        if ($listOverrideOptions != null && is_array($listOverrideOptions)) {
            foreach ($listOverrideOptions as $listOverrideOption) {
                $newStyle = new CreateListStyle();
                $style = $newStyle->addListStyle($listOverrideOption['name'], $listOverrideOption['listOptions'], true);
                $listIdSub = self::uniqueNumberId(999, 32766);

                $newNum = '<w:num w:numId="' . $listIdSub . '">' . $style . '</w:num>';
                // load the new numbering and set the base abstractNumId ID
                $myNumbering = new DOMDocument();
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $prevValueLibXmlInternalErrors = libxml_use_internal_errors(true);
                $myNumbering->loadXML($newNum);
                libxml_clear_errors();
                libxml_use_internal_errors($prevValueLibXmlInternalErrors);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
                $abstractNumId = $myNumbering->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'abstractNumId');
                if ($abstractNumId->length > 0) {
                    $abstractNumId->item(0)->setAttribute('w:val', $listId);
                }
                $newNumbering = $myNumbering->firstChild->ownerDocument->saveXML($myNumbering->firstChild);

                // storage the new numbering
                $mainNumbering = new DOMDocument();
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $prevValueLibXmlInternalErrors = libxml_use_internal_errors(true);
                $mainNumbering->loadXML($this->_wordNumberingT);
                libxml_clear_errors();
                libxml_use_internal_errors($prevValueLibXmlInternalErrors);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
                $new = $mainNumbering->createDocumentFragment();
                $prevValueLibXmlInternalErrors = libxml_use_internal_errors(true);
                $new->appendXML($newNumbering);
                libxml_clear_errors();
                libxml_use_internal_errors($prevValueLibXmlInternalErrors);
                $base = $mainNumbering->documentElement->lastChild;
                $base->parentNode->insertBefore($new, $base->nextSibling);
                $this->_wordNumberingT = $mainNumbering->saveXML();

                self::$customLists[$listOverrideOption['name']]['id'] = $listIdSub;
                self::$customLists[$listOverrideOption['name']]['wordML'] = $style;
            }
        }
    }

    /**
     * Create a new paragraph style and linked char style to be used in your Word document.
     *
     * @access public
     * @param string $name the name we want to give to the created style
     * @param mixed $styleOptions it includes the required style options
     * Array values:
     * 'backgroundColor' (string) hexadecimal value (FFFF00, CCCCCC, ...)
     * 'bidi' (bool) if true sets right to left paragraph orientation
     * 'bold' (bool)
     * 'border' (none, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *      this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom' and 'borderLeft'
     * 'borderColor' (ffffff, ff0000)
     *      this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor' and 'borderLeftColor'
     * 'borderSpacing' (0, 1, 2...)
     *      this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing' and 'borderLeftSpacing'
     * 'borderWidth' (10, 11...) in eights of a point
     *      this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth' and 'borderLeftWidth'
     * 'caps' (bool) display text in capital letters
     * 'color' (ffffff, ff0000...)
     * 'contextualSpacing' (bool) ignore spacing above and below when using identical styles
     * 'doubleStrikeThrough' (bool)
     * 'em' (none, dot, circle, comma, underDot) emphasis mark type
     * 'firstLineIndent' first line indent in twentieths of a point (twips)
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (8, 9, 10, ...) size in half points
     * 'hanging' 100, ...
     * 'hidden' (bool)
     * 'indentLeft' 100, ...
     * 'indentRight' 100, ...
     * 'indentFirstLine' 100, ...
     * 'italic' (bool)
     * 'keepLines' (bool) keep all paragraph lines on the same page
     * 'keepNext' (bool) keep in the same page the current paragraph with next paragraph
     * 'lineSpacing' 120, 240 (standard), 360, 480, ...
     * 'locked' (bool)
     * 'name' (string) forces a name value, otherwise $name is used as styleId and name
     * 'next' (string) style to be automatically applied to the next paragraph with the current style applied
     * 'numberingStyle' numbering style
     * 'outlineLvl' (int) heading level (1-9)
     * 'pageBreakBefore' (bool)
     * 'position'
     * 'pStyle' id of the style this paragraph style is based on (it may be retrieved with the parseStyles method)
     * 'primaryStyle' (bool) if true sets the style as primary style to be displayed in the styles interface
     * 'rtl' (bool) if true sets right to left text orientation
     * 'semiHidden' (bool)
     * 'smallCaps' (bool) display text in small caps
     * 'spacingBottom' (int) bottom margin in twentieths of a point
     * 'spacingTop' (int) top margin in twentieths of a point
     * 'suppressLineNumbers' (bool) suppress line numbers
     * 'tabPositions' (array) each entry is an associative array with the following keys and values
     *      'type' (string) can be clear, left (default), center, right, decimal, bar and num
     *      'leader' (string) can be none (default), dot, hyphen, underscore, heavy and middleDot
     *      'position' (int) given in twentieths of a point
     * 'textAlign' (both, center, distribute, left, right)
     * 'textDirection' (lrTb, tbRl, btLr, lrTbV, tbRlV, tbLrV) text flow direction
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * 'underlineColor' (ffffff, ff0000, ...)
     * 'unhideWhenUsed' (bool)
     * 'vanish' (bool)
     * 'widowControl' (bool)
     * 'wordWrap' (bool)
     */
    public function createParagraphStyle($name, $styleOptions = array())
    {
        $styleOptions = self::translateTextOptions2StandardFormat($styleOptions);
        $newStyle = new CreateParagraphStyle();
        $style = $newStyle->addParagraphStyle($name, $styleOptions);
        //Let's get the original styles
        $styleXML = $this->_wordStylesT->saveXML();
        //append the new styles as a string at the end of the styles file
        $styleXML = str_replace('</w:styles>', $style[0] . '</w:styles>', $styleXML);
        $styleXML = str_replace('</w:styles>', $style[1] . '</w:styles>', $styleXML);
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $this->_wordStylesT->loadXML($styleXML);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }
    }

    /**
     * Create a new table style to be used in your Word document.
     *
     * @access public
     * @param string $name the name we want to give to the created style
     * @param mixed $styleOptions it includes the required style options
     * Array values:
     * 'border' (nil, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *         this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom', 'borderLeft', 'borderInsideH' and 'borderInsideV'
     * 'borderColor' (ffffff, ff0000)
     *         this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor', 'borderLeftColor', 'borderInsideHColor' and 'borderInsideVColor'
     * 'borderSpacing' (0, 1, 2...)
     *         this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing', 'borderLeftSpacing', 'borderInsideHSpacing' and 'borderInsideVSpacing'
     * 'borderWidth' (10, 11...) in eights of a point
     *         this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth', 'borderLeftWidth', 'borderInsideHWidth' and 'borderInsideVWidth'
     * 'cellBackgroundColor' (string) ffffff, ff0000
     * 'cellMargin' (mixed) an integer value or an array:
     *          'top' (int) in twentieths of a point
     *          'right' (int) in twentieths of a point
     *          'bottom' (int) in twentieths of a point
     *          'left' (int) in twentieths of a point
     * 'hidden' (bool)
     * 'indent' (int) given in twips (twentieths of a point)
     * 'locked' (bool)
     * 'next' (string) style to be automatically applied to the next paragraph with the current style applied
     * 'rPrStyles' (array) @see createCharacterStyle
     * 'pPrStyles' (array) @see createParagraphStyle
     * 'semiHidden' (bool)
     * 'tableStyle' id of the style this table style is based on (it may be retrieved with the parseStyles method)
     * 'tblStyleColBandSize' (bool) true or false, banded style
     * 'tblStyleRowBandSize' (bool) true or false, banded style
     * 'unhideWhenUsed' (bool)
     *
     * 'band1HorzStyle' (array) set odd rows styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'band1VertStyle' (array) set odd cols styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'band2HorzStyle' (array) set even rows styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'band2VertStyle' (array) set even cols styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'firstColStyle' (array) set first column styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'firstRowStyle' (array) set first row styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'lastColStyle' (array) set last col styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'lastRowStyle' (array) set last row styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'neCellStyle' (array) set top right styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'nwCellStyle' (array) set top left styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'seCellStyle' (array) set bottom right styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     * 'swCellStyle' (array) set bottom left styles using border, borderColor, borderSpacing, borderWidth, backgroundColor, vAlign, rPrStyles, pPrStyles properties
     */
    public function createTableStyle($name, $styleOptions = array())
    {
        $newStyle = new CreateTableStyle();
        $style = $newStyle->addTableStyle($name, $styleOptions);

        //Let's get the original styles
        $styleXML = $this->_wordStylesT->saveXML();
        //append the new styles as a string at the end of the styles file
        $styleXML = str_replace('</w:styles>', $style . '</w:styles>', $styleXML);
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $this->_wordStylesT->loadXML($styleXML);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }
    }

    /**
     * Customize styles of a Word content
     *
     * @access public
     * @param array $referenceNode
     * Keys and values:
     *     'target' (string) document (default), style, lastSection, header, footer
     *     'type' (string) break, image, list, paragraph, run, section, style, table, table-row, table-cell
     *     'contains' (string) for list, paragraph (text, bookmark, link)
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     *     'reference' (array) for header and footer targets, allowed keys:
     *         'positions' (array) 1, 2... based on the sectPr contents order
     *         'sections' (array) 1, 2...
     *         'types' (array) 'first', 'even', 'default'
     * @param array $options Style options to apply to the content
     * Values break:
     *     'type' (line, page)
     * Values image:
     *     'borderColor' (string)
     *     'borderStyle'(string) can be solid, dot, dash, lgDash, dashDot, lgDashDot, lgDashDotDot, sysDash, sysDot, sysDashDot, sysDashDotDot
     *     'borderWidth' (int) given in emus (1cm = 360000 emus)
     *     'height' (int) in emus (1cm = 360000 emus)
     *     'imageAlign' (center, left, right, inside, outside)
     *     'spacingBottom' (int) in emus (1cm = 360000 emus)
     *     'spacingLeft' (int) in emus (1cm = 360000 emus)
     *     'spacingRight' (int) in emus (1cm = 360000 emus)
     *     'spacingTop' (int) in emus (1cm = 360000 emus)
     *     'width' (int) in emus (1cm = 360000 emus)
     * Values list. The same as paragraph and:
     *     'depthLevel' (int) item level
     *     'type' (int) 0 (clear), 1 (inordinate), 2 (numerical)
     * Values paragraph:
     *     'backgroundColor' (string) hexadecimal value (FFFF00, CCCCCC, ...)
     *     'bold' (bool)
     *     'caps' (bool) display text in capital letters
     *     'color' (ffffff, ff0000...)
     *     'contextualSpacing' (bool) ignore spacing above and below when using identical styles
     *     'dstrike' (bool) displays text in doubleStrikeThrough
     *     'em' (none, dot, circle, comma, underDot) emphasis mark type
     *     'font' (Arial, Times New Roman...)
     *     'fontSize' (8, 9, 10, ...) size in points
     *     'headingLevel' (int) the heading level, if any
     *     'italic' (bool)
     *     'keepLines' (bool) keep all paragraph lines on the same page
     *     'keepNext' (bool) keep in the same page the current paragraph with next paragraph
     *     'lineSpacing' 120, 240 (standard), 360, 480...
     *     'pageBreakBefore' (bool)
     *     'pStyle' (string) Word style
     *     'smallCaps' (bool) displays text in small capital letters
     *     'spacingBottom' (int) bottom margin in twentieths of a point
     *     'spacingTop' (int) top margin in twentieths of a point
     *     'strike' (bool) displays text in strikethrough
     *     'textAlign' (both, center, distribute, left, right)
     *     'underline' (none, dash, dotted, double, single, wave, words)
     *     'underlineColor' (ffffff, ff0000, ...)
     *     'vanish' (bool)
     * Values run:
     *     'bold' (bool)
     *     'caps' (bool) display text in capital letters
     *     'characterBorder' (array). Keys:
     *         'type' => none, single, double, dashed...
     *         'color' => ffffff, ff0000
     *         'spacing' => 0, 1, 2...
     *         'width' => in eights of a point
     *     'contextualSpacing' (bool) ignore spacing above and below when using identical styles
     *     'dstrike' (bool) displays text in doubleStrikeThrough
     *     'em' (none, dot, circle, comma, underDot) emphasis mark type
     *     'font' (Arial, Times New Roman...)
     *     'fontSize' (8, 9, 10, ...) size in points
     *     'highlight' (string) color name (yellow, red, ...)
     *     'italic' (bool)
     *     'position' (int) position value, positive value for raised and negative value for lowered
     *     'scaling' (int) scaling value, 100 is the default value
     *     'smallCaps' (bool) displays text in small capital letters
     *     'spacing' (int) character spacing, positive value for expanded and negative value for condensed
     *     'strike' (bool) displays text in strikethrough
     *     'underline' (none, dash, dotted, double, single, wave, words)
     *     'underlineColor' (ffffff, ff0000, ...)
     *     'vanish' (bool)
     * Values section:
     *     'gutter' (int): measurement in twips (twentieths of a point)
     *     'height' (int): measurement in twips (twentieths of a point)
     *     'marginBottom' (int): measurement in twips (twentieths of a point)
     *     'marginFooter' (int): measurement in twips (twentieths of a point)
     *     'marginHeader' (int): measurement in twips (twentieths of a point)
     *     'marginLeft' (int): measurement in twips (twentieths of a point)
     *     'marginRight' (int): measurement in twips (twentieths of a point)
     *     'marginTop' (int): measurement in twips (twentieths of a point)
     *     'numberCols' (int): number of columns
     *     'orient' (string): portrait, landscape
     *     'space' (int): column spacing, measurement in twips (twentieths of a point)
     *     'width' (int): measurement in twips (twentieths of a point)
     * Values style. Check paragraph values
     * Values table:
     *     'border' (nil, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *         this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom', 'borderLeft', 'borderInsideH' and 'borderInsideV'
     *     'borderColor' (ffffff, ff0000)
     *         this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor', 'borderLeftColor', 'borderInsideHColor' and 'borderInsideVColor'
     *     'borderSpacing' (0, 1, 2...)
     *         this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing', 'borderLeftSpacing', 'borderInsideHSpacing' and 'borderInsideVSpacing'
     *     'borderWidth' (10, 11...) in eights of a point
     *         this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth', 'borderLeftWidth', 'borderInsideHWidth' and 'borderInsideVWidth'
     *     'cellMargin' (array) the keys are top, right, bottom and left and the values is given in twips (twentieths of a point)
     *     'cellSpacing' (int) given in twips (twentieths of a point)
     *     'columnWidths': column width fix (int) column width variable (array)
     *     'indent' (int) given in twips (twentieths of a point)
     *     'tableAlign' (center, left, right)
     *     'tableStyle' (string) Word table style
     *     'tableWidth' (array) its posible keys and values are:
     *         'type' (pct, dxa) pct if the value refers to percentage and dxa if the value is given in twentieths of a point (twips)
     *         'value' (int)
     * Values table-row:
     *     'height' (int) in twentieths of a point
     *     'minHeight' (int) in twentieths of a point
     * Values table-cell:
     *     'backgroundColor' (ffffff, ff0000)
     *     'border' (nil, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *         this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom', 'borderLeft', 'borderInsideH' and 'borderInsideV'
     *     'borderColor' (ffffff, ff0000)
     *         this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor', 'borderLeftColor', 'borderInsideHColor' and 'borderInsideVColor'
     *     'borderSpacing' (0, 1, 2...)
     *         this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing', 'borderLeftSpacing', 'borderInsideHSpacing' and 'borderInsideVSpacing'
     *     'borderWidth' (10, 11...) in eights of a point
     *         this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth', 'borderLeftWidth', 'borderInsideHWidth' and 'borderInsideVWidth'
     *     'cellMargin' (array) the keys are top, right, bottom and left and the values is given in twips (twentieths of a point)
     *     'fitText' (bool) if true fits the text to the size of the cell
     *     'rowspan' (int)
     *     'vAlign' (string) vertical align of text: top, center, both or bottom
     *     'width' (int) in twentieths of a point
     * Common values:
     *     'customAttributes' (array)
     * @return void
     * @throws Exception method not available
     */
    public function customizeWordContent($referenceNode, $options = array())
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXCustomizer.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // choose the reference node based on content
        if (!isset($referenceNode['type'])) {
            $referenceNode['type'] = '*';
        }

        // set the target, document as default
        if (!isset($referenceNode['target'])) {
            $referenceNode['target'] = 'document';
        }

        // add the type value to the array options to be used in the DOCXCustomizer class
        $options['tagType'] = $referenceNode['type'];

        if ($referenceNode['target'] == 'header' || $referenceNode['target'] == 'footer') {
            // not document targets

            $contents = $this->getWordContentByRels($referenceNode);

            if (count($contents) > 0) {
                $query = $this->getWordContentQuery($referenceNode);
                foreach ($contents as $content) {
                    $domDocument = $content['document'];
                    $domXpath = $content['documentXpath'];
                    $target = $content['target'];

                    $contentNodes = $domXpath->query($query);

                    if ($contentNodes->length > 0) {
                        $customizer = new DOCXCustomizer();
                        foreach ($contentNodes as $contentNode) {
                            $customizer->customize($contentNode, $options);
                        }

                        $this->saveToZip($contentNode->ownerDocument->saveXML(), $target);
                    }
                }
            }
        } else {
            // default as document
            list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);
            $query = $this->getWordContentQuery($referenceNode);

            $contentNodes = $domXpath->query($query);
            if ($contentNodes->length > 0) {
                $customizer = new DOCXCustomizer();
                foreach ($contentNodes as $contentNode) {
                    $customizer->customize($contentNode, $options);
                }

                $this->regenerateXMLContent($referenceNode['target'], $domDocument);
            }
        }
    }

    /**
     * Disable tracking
     *
     * @access public
     * @throws Exception method not available
     */
    public function disableTracking()
    {
        if (!file_exists(dirname(__FILE__) . '/Tracking.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        PhpdocxLogger::logger('Disable tracking.', 'info');

        self::$trackingEnabled = false;
    }

    /**
     * Stablish the general docx settings in settings.xml
     *
     * @access public
     * @param array settings
     * Keys and values:
     * 'view' (string): none(default), print, outline, masterPages, normal (draft view), web
     * 'zoom'(mixed): a percentage or none, fullPage (display one full page), bestFit (display page width), textFit (display text width)
     * 'mirrorMargins' (bool) if true interchanges inside and outside margins in odd and even pages
     * 'bordersDoNotSurroundHeader' (bool)
     * 'bordersDoNotSurroundFooter' (bool)
     * 'gutterAtTop' (bool)
     * 'hideSpellingErrors' (bool)
     * 'hideGrammaticalErrors' (bool)
     * 'documentType' (string): notSpecified (default), letter, eMail
     * 'trackRevisions' (bool)
     * 'defaultTabStop'(int) in twips (twentieths of a point)
     * 'autoHyphenation' (bool)
     * 'consecutiveHyphenLimit'(int): maximum number of consecutively hyphenated lines
     * 'hyphenationZone' (int) distance in twips (twentieths of a point)
     * 'doNotHyphenateCaps' (bool): do not hyphenate capital letters
     * 'defaultTableStyle' (string): the table style to be used by default
     * 'bookFoldRevPrinting' (bool): reverse book fold printing
     * 'bookFoldPrinting' (bool): book fold printing
     * 'bookFoldPrintingSheets' (int): number of pages per booklet
     * 'doNotShadeFormData' (bool)
     * 'noPunctuationKerning' (bool): never kern punctuation characters
     * 'printTwoOnOne' (bool): print two pages per sheet
     * 'savePreviewPicture' (bool): generate thumbnail for document on save
     * 'updateFields' (bool): automatically recalculate fields on open
     * 'compat' (array): set compat settings
     * 'customSetting' (array): set custom settings
     *
     * @return void
     */
    public function docxSettings($settingParameters)
    {
        $settingParams = array(
            'view',
            'zoom',
            'displayBackgroundShape',
            'mirrorMargins',
            'bordersDoNotSurroundHeader',
            'bordersDoNotSurroundFooter',
            'gutterAtTop',
            'hideSpellingErrors',
            'hideGrammaticalErrors',
            'documentType',
            'trackRevisions',
            'defaultTabStop',
            'autoHyphenation',
            'consecutiveHyphenLimit',
            'hyphenationZone',
            'doNotHyphenateCaps',
            'defaultTableStyle',
            'bookFoldRevPrinting',
            'bookFoldPrinting',
            'bookFoldPrintingSheets',
            'doNotShadeFormData',
            'noPunctuationKerning',
            'printTwoOnOne',
            'savePreviewPicture',
            'updateFields',
            'compat',
            'customSetting',
        );
        foreach ($settingParameters as $tag => $value) {
            if ((!in_array($tag, $settingParams))) {
                PhpdocxLogger::logger('That setting tag is not supported.', 'info');
            } else {
                $settingIndex = array_search('w:' . $tag, OOXMLResources::$settings);
                $selectedElements = $this->_wordSettingsT->documentElement->getElementsByTagName($tag);
                if ($tag == 'customSetting' && is_array($value)) {
                    $selectedElements = $this->_wordSettingsT->documentElement->getElementsByTagName($value['tag']);
                }
                if ($selectedElements->length == 0) {
                    $settingsElement = $this->_wordSettingsT->createDocumentFragment();
                    if ($tag == 'zoom') {
                        if (is_numeric($value)) {
                            $settingsElement->appendXML('<w:' . $tag . ' xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" w:percent = "' . $value . '"/>');
                        } else {
                            $settingsElement->appendXML('<w:' . $tag . ' xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" w:val = "' . $value . '"/>');
                        }
                    } else if ($tag == 'customSetting' && is_array($value)) {
                        $attributesCustomSetting = '';
                        foreach ($value['values'] as $keyValue => $valueValue) {
                            $attributesCustomSetting .= $keyValue . '="' . $valueValue . '" ';
                        }
                        $settingsElement->appendXML('<w:' . $value['tag'] . ' xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" ' . $attributesCustomSetting . '/>');
                    } else if ($tag == 'compat' && is_array($value)) {
                        // create the compat tag and its children
                        $compatTagContent = '<w:compat xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main">';
                        foreach ($value as $keyValue => $valueValue) {
                            $compatTagContent .= '<w:compatSetting xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" w:name="' . $keyValue . '" w:uri="http://schemas.microsoft.com/office/word" w:val="' . $valueValue['val'] . '"/>';
                        }
                        $compatTagContent .= '</w:compat>';
                        $settingsElement->appendXML($compatTagContent);
                    } else {
                        $settingsElement->appendXML('<w:' . $tag . ' xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" w:val = "' . $value . '"/>');
                    }
                    $childNodes = $this->_wordSettingsT->documentElement->childNodes;
                    $index = false;
                    foreach ($childNodes as $node) {
                        $name = $node->nodeName;
                        $index = array_search($node->nodeName, OOXMLResources::$settings);
                        if ($index > $settingIndex) {
                            $node->parentNode->insertBefore($settingsElement, $node);
                            break;
                        }
                    }
                    // in case no node was found (pretty unlikely)we should append the node
                    if (!$index) {
                        $this->_wordSettingsT->documentElement->appendChild($settingsElement);
                    }
                } else {
                    // that setting is already present
                    if ($tag == 'zoom') {
                        $selectedElements->item(0)->removeAttribute('w:val');
                        $selectedElements->item(0)->removeAttribute('w:percent');
                        if (is_numeric($value)) {
                            $selectedElements->item(0)->setAttribute('w:percent', $value);
                        } else {
                            $selectedElements->item(0)->setAttribute('w:val', $value);
                        }
                    } else if ($tag == 'customSetting' && is_array($value)) {
                        foreach ($value['values'] as $keyValue => $valueValue) {
                            $selectedElements->item(0)->setAttribute($keyValue, $valueValue);
                        }
                    } else if ($tag == 'compat' && is_array($value)) {
                        foreach ($value as $keyValue => $valueValue) {
                            // create the compatSetting tag if doesn't exist. Otherwise change its val attribute
                            $wordSettingsXPath = new DOMXPath($this->_wordSettingsT);
                            $wordSettingsXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                            $query = '//w:compatSetting[@w:name="' . $keyValue . '"]';
                            $compatSettingsElement = $wordSettingsXPath->query($query);

                            if ($compatSettingsElement->length == 0) {
                                $settingsElement = $this->_wordSettingsT->createDocumentFragment();
                                $settingsElement->appendXML('<w:compatSetting xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" w:name="' . $keyValue . '" w:uri="http://schemas.microsoft.com/office/word" w:val="' . $valueValue['val'] . '"/>');
                                $selectedElements->item(0)->appendChild($settingsElement);
                            } else {
                                $compatSettingsElement->item(0)->setAttribute('w:val', $valueValue['val']);
                            }
                        }
                    } else {
                        $selectedElements->item(0)->setAttribute('w:val', $value);
                    }
                }
            }
        }
    }

    /**
     *
     * Transform a word document to a text file
     *
     * @param string $path. Path to the docx from which we wish to import the content
     * @param string $path. Path to the text file output
     * @param array styles.
     * keys: table => true/false,list => true/false, paragraph => true/false, footnote => true/false, endnote => true/false, chart => (0=false,1=array,2=table)
     */
    public static function docx2txt($from, $to, $options = array())
    {
        $text = new Docx2Text($options);
        $text->setDocx($from);
        $text->extract($to);
    }

    /**
     * Generates a unique number not used in elements of the document
     * @access protected
     * @static
     * @param int $min
     * @param int $max
     * @return int
     */
    public static function uniqueNumberId($min, $max)
    {
        $proposedId = mt_rand($min, $max);
        if (in_array($proposedId, self::$elementsId)) {
            $proposedId = self::uniqueNumberId($min, $max);
        }
        self::$elementsId[] = $proposedId;

        return $proposedId;
    }

    /**
     * Embeds a TTF font file
     *
     * @param string $fontSource. TTF font
     * @param string $fontName. Font name
     * @param array $options
     *      'charset' (string) 00 as default
     *      'styleEmbedding' (string) Regular (default), Bold, Italic, BoldItalic
     * @throws Exception method not available
     */
    public function embedFont($fontSource, $fontName, $options = array())
    {
        if (!file_exists(dirname(__FILE__) . '/Fonts.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // default values
        if (!isset($options['charset'])) {
            $options['charset'] = '00';
        }
        if (isset($options['styleEmbeding'])) {
            $options['styleEmbedding'] = $options['styleEmbeding'];
        }
        if (!isset($options['styleEmbedding'])) {
            $options['styleEmbedding'] = 'embedRegular';
        } else {
            // concat embed as prefix
            $options['styleEmbedding'] = 'embed' . ucfirst($options['styleEmbedding']);
        }

        if (file_exists($fontSource)) {
            $font = new Fonts();
            $odttfFont = $font->generateODTTF($fontSource);
            PhpdocxLogger::logger('Add font word/fonts/font', 'info');

            // handle xml rels
            // if doesn't exist the rels file, create it
            if ($this->getFromZip('word/_rels/fontTable.xml.rels') === false) {
                $this->saveToZip(OOXMLResources::$notesXMLRels, 'word/_rels/fontTable.xml.rels');
            }
            $fontTableDom = $this->getFromZip('word/fontTable.xml', 'DOMDocument');
            $fontTableRelsDom = $this->getFromZip('word/_rels/fontTable.xml.rels', 'DOMDocument');
            // generate a random ID for the new font
            $idFont = self::uniqueNumberId(999, 99999999);

            // check if the same font name already exists. If true, add the new embeded font to the w:font tag only if the styleEmbedding doesn't exist
            $fontTableXPath = new DOMXPath($fontTableDom);
            $fontTableXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
            $queryFontName = '//w:font[@w:name = "' . $fontName . '"]';
            $fontQuery = $fontTableXPath->query($queryFontName);
            if ($fontQuery->length > 0) {
                // add the new embed font to the existing w:font tag if the styleEmbedding doesn't exist
                $fontQueryEmbed = $fontQuery->item(0)->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', $options['styleEmbedding']);
                if ($fontQueryEmbed->length == 0) {
                    // font entry to be added
                    $fontEntry = '<w:' . $options['styleEmbedding'] . ' r:id="rId' . $idFont . '" w:fontKey="' . $odttfFont['guid'] . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"/>';

                    $fontElement = $fontTableDom->createDocumentFragment();
                    $fontElement->appendXML($fontEntry);
                    $fontQuery->item(0)->appendChild($fontElement);

                    // add the new font to xml.rels and DOCX
                    $fontRelsElement = $fontTableRelsDom->createDocumentFragment();
                    $fontRelsElement->appendXML('<Relationship Id="rId' . $idFont . '" Target="fonts/font' . $idFont . '.odttf" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/font"/>');
                    $fontTableRelsDom->firstChild->appendChild($fontRelsElement);

                    $this->_zipDocx->addContent('word/fonts/font' . $idFont . '.odttf' , $odttfFont['odttf']);

                    $this->saveToZip($fontTableDom, 'word/fontTable.xml');
                    $this->saveToZip($fontTableRelsDom, 'word/_rels/fontTable.xml.rels');
                }
            } else {
                // there's no font with the chosen name. Generate the w:font tag
                $fontTableNewEntry = $font->generateFontEntry($odttfFont['guid'], 'rId' . $idFont, $fontName, $options);

                $fontElement = $fontTableDom->createDocumentFragment();
                $fontElement->appendXML($fontTableNewEntry);
                $fontTableDom->firstChild->appendChild($fontElement);

                // add the new font to xml.rels and DOCX
                $fontRelsElement = $fontTableRelsDom->createDocumentFragment();
                $fontRelsElement->appendXML('<Relationship Id="rId' . $idFont . '" Target="fonts/font' . $idFont . '.odttf" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/font"/>');
                $fontTableRelsDom->firstChild->appendChild($fontRelsElement);

                $this->_zipDocx->addContent('word/fonts/font' . $idFont . '.odttf' , $odttfFont['odttf']);

                $this->saveToZip($fontTableDom, 'word/fontTable.xml');
                $this->saveToZip($fontTableRelsDom, 'word/_rels/fontTable.xml.rels');
            }

            // add the Default type if needed
            $this->generateDEFAULT('odttf', 'application/vnd.openxmlformats-officedocument.obfuscatedFont');
        } else {
            PhpdocxLogger::logger('File ' . $fontSource . ' does not exist.', 'warning');
        }
    }

    /**
     * Embed HTML into the Word document by parsing the HTML code and converting it into WordML
     * It preserves many CSS styles
     *
     * @access public
     * @param string $html HTML to add. Must be a valid HTML
     * @param array $options:
     * 'isFile' (bool)
     * 'addDefaultStyles' (bool) true as default, if false prevents adding default styles when strictWordStyles is false
     * 'baseURL' (string)
     * 'cssEntityDecode' (bool) Default as false. If true, use html_entity_decode to parse CSS, useful when using font families with not standard names such as chinese, japanese, korean and others
     * 'customListStyles' (bool) default as false. If true try to use the predefined custom lists
     * 'disableWrapValue' (bool) default as false. If true disable using a wrap value with Tidy
     * 'downloadImages' (bool) default as true. If false don't download the images, link them as external files
     * 'embedFonts' (bool) default as false. If true download and embed TTF fonts from font-face styles
     * 'filter' (string) could be an string denoting the id, class or tag to be filtered
     * If you want only a class introduce .classname, #idName for an id or <htmlTag> for a particular tag. One can also use
     * standard XPath expresions supported by PHP.
     * 'forceNotTidy' (bool) False as default. If true, avoid using Tidy. Only recommended if Tidy can't be installed
     * 'generateCustomListStyles' (bool) default as true. If true generates automatically the custom list styles from the list styles (decimal, lower-alpha, lower-latin, lower-roman, upper-alpha, upper-latin, upper-roman)
     * 'parseAnchors' (bool)
     * 'parseDivs' (paragraph, table): parses divs as paragraphs or tables
     * 'parseFloats' (bool)
     * 'removeLineBreaks' (bool), if true removes line breaks that can be generated when transforming HTML
     * 'strictWordStyles' (bool) if true ignores all CSS styles and uses the styles set via the wordStyles option (see wordStyles)
     * 'useHTMLExtended' (bool)  if true uses HTML extended tags and CSS extended styles. Default as false
     * 'wordStyles' (array) associates a particular class, id or HTML tag to a Word style
     * @throws Exception tidy is not available and forceNotTidy is false
     */
    public function embedHTML($html = '<html><body></body></html>', $options = array())
    {
        if (!isset($options['forceNotTidy'])) {
            $options['forceNotTidy'] = false;
        }

        if (!extension_loaded('tidy') && !$options['forceNotTidy']) {
            throw new Exception('Install and enable Tidy for PHP (http://php.net/manual/en/book.tidy.php) to transform HTML to DOCX.');
        }

        $class = get_class($this);
        if ($class != 'CreateDocx' && isset($this->target)) {
            $options['target'] = $this->target;
        } else {
            $options['target'] = 'document';
        }

        if (!isset($options['disableWrapValue'])) {
            $options['disableWrapValue'] = false;
        }

        if (!isset($options['downloadImages'])) {
            $options['downloadImages'] = true;
        }

        if (!isset($options['generateCustomListStyles'])) {
            $options['generateCustomListStyles'] = true;
        }

        if (!isset($options['useHTMLExtended'])) {
            $options['useHTMLExtended'] = false;
        }

        if (!isset($options['embedFonts'])) {
            $options['embedFonts'] = false;
        }

        // replace math equations by placeholders to be able to add them using HTML
        $nodesMathEquation = array();
        if (file_exists(dirname(__FILE__) . '/HTMLExtended.php') && $options['useHTMLExtended'] && strpos($html, '<math') !== false) {
            preg_match_all('/<math(.*?)<\/math>/mis', $html, $equations);
            $i_mathml = 0;
            foreach ($equations[0] as $equation) {
                $html = str_replace($equation, 'PHPDOCX_HTML_EQUATION_'.$i_mathml, $html);
                $nodesMathEquation['PHPDOCX_HTML_EQUATION_'.$i_mathml] = $equation;
                $i_mathml++;
            }
        }

        $htmlDOCX = new HTML2WordML($this->_zipDocx);
        $sFinalDocX = $htmlDOCX->render($html, $options, $this);
        PhpdocxLogger::logger('Add converted HTML to word document.', 'info');

        $this->HTMLRels($sFinalDocX, $options);
        // take care of the ordered lists if they exist
        if (is_array($sFinalDocX[3])) {
            foreach ($sFinalDocX[3] as $value) {
                $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, OOXMLResources::$orderedListStyle, $value);

                // handle and generate the list styles
                if (isset($options['generateCustomListStyles']) && $options['generateCustomListStyles']) {
                    if ($this->_wordNumberingT && is_array($sFinalDocX[5]) && isset($sFinalDocX[5][$value])) {
                        $newNumbering = new DOMDocument();
                        if (PHP_VERSION_ID < 80000) {
                            $optionEntityLoader = libxml_disable_entity_loader(true);
                        }
                        $newNumbering->loadXML($this->_wordNumberingT);
                        if (PHP_VERSION_ID < 80000) {
                            libxml_disable_entity_loader($optionEntityLoader);
                        }

                        $numXPath = new DOMXPath($newNumbering);
                        $numXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        foreach ($sFinalDocX[5][$value] as $valueNumbering) {
                            $query = '//w:abstractNum[@w:abstractNumId = "' . $value . '"]/w:lvl[@w:ilvl = "' . $valueNumbering['level'] . '"]/w:numFmt';
                            $numberingNumFmt = $numXPath->query($query);
                            $newStyle = 'decimal';
                            if (isset($valueNumbering['style'])) {
                                switch ($valueNumbering['style']) {
                                    case 'decimal':
                                    case '1':
                                        $newStyle = 'decimal';
                                        break;
                                    case 'lower-alpha':
                                    case 'lower-latin':
                                    case 'a':
                                        $newStyle = 'lowerLetter';
                                        break;
                                    case 'lower-roman':
                                    case 'i':
                                        $newStyle = 'lowerRoman';
                                        break;
                                    case 'upper-alpha':
                                    case 'upper-latin':
                                    case 'A':
                                        $newStyle = 'upperLetter';
                                        break;
                                    case 'upper-roman':
                                    case 'I':
                                        $newStyle = 'upperRoman';
                                        break;
                                    default:
                                        break;
                                }
                            }
                            $numberingNumFmt->item(0)->setAttribute('w:val', $newStyle);

                            // start value
                            if (isset($valueNumbering['start']) && !empty($valueNumbering['start'])) {
                                $query = '//w:abstractNum[@w:abstractNumId = "' . $value . '"]/w:lvl[@w:ilvl = "' . $valueNumbering['level'] . '"]/w:start';
                                $numberingStart = $numXPath->query($query);
                                $numberingStart->item(0)->setAttribute('w:val', $valueNumbering['start']);
                            }
                        }
                        $this->_wordNumberingT = $newNumbering->saveXML();
                    }
                }
            }
        }

        // take care of the custom lists if they exist
        if (is_array($sFinalDocX[4])) {
            foreach ($sFinalDocX[4] as $value) {
                if (isset($value['name'])) {
                    // remove from the name the random indentifier
                    $realNameArray = explode('_', $value['name']);
                    $value['name'] = $realNameArray[0];

                    if (isset(self::$customLists[$value['name']]['wordML'])) {
                        // get the numbering ID to be replaced by the new value
                        $importNumberingDoc = new DOMDocument();
                        if (PHP_VERSION_ID < 80000) {
                            $optionEntityLoader = libxml_disable_entity_loader(true);
                        }
                        if (!strstr(self::$customLists[$value['name']]['wordML'], 'xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"')) {
                            $prevValueLibXmlInternalErrors = libxml_use_internal_errors(true);
                            $importNumberingDoc->loadXML(str_replace('<w:abstractNum', '<w:abstractNum xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" ', self::$customLists[$value['name']]['wordML']));
                            libxml_clear_errors();
                            libxml_use_internal_errors($prevValueLibXmlInternalErrors);
                        } else {
                            $prevValueLibXmlInternalErrors = libxml_use_internal_errors(true);
                            $importNumberingDoc->loadXML(self::$customLists[$value['name']]['wordML']);
                            libxml_clear_errors();
                            libxml_use_internal_errors($prevValueLibXmlInternalErrors);
                        }
                        if (PHP_VERSION_ID < 80000) {
                            libxml_disable_entity_loader($optionEntityLoader);
                        }
                        $numXPath = new DOMXPath($importNumberingDoc);
                        $numXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = '//w:abstractNum';
                        $numbering = $numXPath->query($query);
                        $abstractNumId = '';
                        if ($numbering->length > 0) {
                            $abstractNumId = $numbering->item(0)->getAttribute('w:abstractNumId');
                        }

                        $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, self::$customLists[$value['name']]['wordML'], $value['id'], $abstractNumId, true);
                    }
                }

                if (isset($value['attributes'])) {
                    foreach ($value['attributes'] as $attribute) {
                        if (isset($attribute['start']) && $attribute['start'] && $attribute['start'] != 1) {
                            // overwrite the start value from the imported HTML/CSS values
                            $newNumberingDOM = new DOMDocument();
                            if (PHP_VERSION_ID < 80000) {
                                $optionEntityLoader = libxml_disable_entity_loader(true);
                            }
                            $newNumberingDOM->loadXML($this->_wordNumberingT);
                            if (PHP_VERSION_ID < 80000) {
                                libxml_disable_entity_loader($optionEntityLoader);
                            }
                            $newNumberingDOMXPath = new DOMXPath($newNumberingDOM);
                            $newNumberingDOMXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                            $query = '//w:abstractNum[@w:abstractNumId = "' . $value['id'] . '"]/w:lvl[@w:ilvl = "' . $attribute['listLevel'] . '"]/w:start';
                            $numberingStart = $newNumberingDOMXPath->query($query);
                            if ($numberingStart->item(0) && $numberingStart->item(0)->getAttribute('w:val') == '1') {
                                $numberingStart->item(0)->setAttribute('w:val', $attribute['start']);
                            }

                            $this->_wordNumberingT = $newNumberingDOM->saveXML();
                        }
                    }
                }

                if (file_exists(dirname(__FILE__) . '/HTMLExtended.php') && $options['useHTMLExtended']) {
                    if (isset($value['lvlOverride']) && count($value['lvlOverride']) > 0) {
                        foreach ($value['lvlOverride'] as $valueLvlOverride) {
                            // clone lvlOverrides tags and add them into $this->_wordNumberingT
                            $newOverrideTags = '<w:num w:numId="'.$value['id'].'"><w:abstractNumId w:val="'.$value['id'].'"/></w:num><w:num w:numId="'.$valueLvlOverride['id'].'">' . str_replace('<w:abstractNumId w:val=""', '<w:abstractNumId w:val="'.$value['id'].'"', CreateDocx::$customLists[$valueLvlOverride['listStyle']]['wordML']) . '</w:num></w:numbering>';
                            $this->_wordNumberingT = str_replace('</w:numbering>', $newOverrideTags, $this->_wordNumberingT);
                        }
                    }
                }
            }
        }

        // replace MathML placeholders
        if (file_exists(dirname(__FILE__) . '/HTMLExtended.php') && $options['useHTMLExtended'] && count($nodesMathEquation) > 0) {
            foreach ($nodesMathEquation as $keyNode => $valueNode) {
                // remove extra line breaks
                $sFinalDocX[0] = str_replace("\n".$keyNode."\n", $keyNode, $sFinalDocX[0]);
                $eq = new WordFragment();
                $eq->addMathEquation($valueNode, 'mathml');
                $sFinalDocX[0] = str_replace($keyNode, '</w:t></w:r>'.$eq->inlineWordML().'<w:r><w:t>', $sFinalDocX[0]);
            }

        }

        if ($class == 'WordFragment') {
            if (isset($options['removeLineBreaks']) && $options['removeLineBreaks'] == true) {
                $cleanOutput = (string) str_replace(array("\r\n", "\n"), ' ', $sFinalDocX[0]);
                $cleanOutput = (string) str_replace('<w:t xml:space="preserve"> ', '<w:t xml:space="preserve">', $cleanOutput);
                $this->wordML .= $cleanOutput;
            } else {
                $this->wordML .= (string) $sFinalDocX[0];
            }
        } else {
            if (isset($options['removeLineBreaks']) && $options['removeLineBreaks'] == true) {
                $cleanOutput = (string) str_replace(array("\r\n", "\n"), ' ', $sFinalDocX[0]);
                $cleanOutput = (string) str_replace('<w:t xml:space="preserve"> ', '<w:t xml:space="preserve">', $cleanOutput);
                $this->_wordDocumentC .= $cleanOutput;
            } else {
                $this->_wordDocumentC .= (string) $sFinalDocX[0];
            }
        }
    }

    /**
     * Enable repair mode to fix common issues when working with LibreOffice automatically
     *
     * @access public
     * @param array $options:
     *        lastParagraph (bool), false as default
     *        lists (bool), true as default
     *        tables (bool), true as default
     * @throws Exception method not available
     */
    public function enableRepairMode($options = array())
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        PhpdocxLogger::logger('Enable repair mode.', 'info');

        if (isset($options['lastParagraph']) && $options['lastParagraph'] == true) {
            $referenceNode = array(
                'type' => 'paragraph',
                'occurrence' => '-1',
            );

            $this->removeWordContent($referenceNode);
        }

        // default values
        if (!isset($options['lists'])) {
            $options['lists'] = true;
        }
        if (!isset($options['tables'])) {
            $options['tables'] = true;
        }

        $this->_repairMode = $options;
    }

    /**
     * Enable tracking
     *
     * @access public
     * @param array $options Tracking information
     *   'author' (string). Optional
     *   'date' (string). Optional, force a date, otherwise auto generate it
     * @throws Exception method not available, missing author name
     */
    public function enableTracking($options = array())
    {
        if (!file_exists(dirname(__FILE__) . '/Tracking.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        if (!isset($options['author'])) {
            PhpdocxLogger::logger('The author name is required.', 'fatal');
        }

        PhpdocxLogger::logger('Enable tracking.', 'info');

        self::$trackingEnabled = true;

        self::$trackingOptions = $options;

        // set a default if not set
        if (!isset(self::$trackingOptions['date'])) {
            self::$trackingOptions['date'] = substr(date(DATE_W3C), 0, 19) . 'Z';
        }

        // generate a random ID
        self::$trackingOptions['id'] = rand(9999999, 99999999);
    }

    /**
     * Creates an empty word numbering base string
     *
     * @return string
     * @throws Exception error opening the file
     */
    public function generateBaseWordNumbering()
    {
        // copy the numbering.xml file from the standard PHPDocX template into the new base template
        $numZip = new ZipArchive();
        try {
            $openNumZip = $numZip->open(PHPDOCX_BASE_TEMPLATE);
            if ($openNumZip !== true) {
                throw new Exception('Error while opening the standard base template to extract the word/numbering.xml file');
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
        $baseWordNumbering = $numZip->getFromName('word/numbering.xml');
        $numZip->close();

        return $baseWordNumbering;
    }

    /**
     * Return the info of a DOCXPath query such as number of elements and the xpath query
     *
     * @access public
     * @param array $referenceNode (if empty or null force append)
     * Keys and values:
     *     'type' (string) can be * (all, default value), bookmark, break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for links and lists), section, shape, table, tracking-insert, tracking-delete, tracking-run-style, tracking-paragraph-style, tracking-table-style, tracking-table-grid, tracking-table-row
     *     'contains' (string) for bookmark, list, paragraph (text, link), shape
     *     'occurrence' (int)
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     *     'target' (string) document (default), header, footer
     *     'reference' (array) for header and footer targets, allowed keys:
     *         'positions' (array) 1, 2... based on the sectPr contents order
     *         'sections' (array) 1, 2...
     *         'types' (array) 'first', 'even', 'default'
     * @return void|array
     * @throws Exception method not available
     */
    public function getDOCXPathQueryInfo($referenceNode)
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // choose the reference node based on content
        if (!isset($referenceNode['type'])) {
            $referenceNode['type'] = '*';
        }

        // manage types with more than one tag
        if ($referenceNode['type'] == 'bookmark') {
            $referenceNode['type'] = 'bookmarkStart';
        }

        // target
        if (!isset($referenceNode['target'])) {
            $referenceNode['target'] = 'document';
        }

        // reference
        if (!isset($referenceNode['reference'])) {
            $referenceNode['reference'] = array();
        }

        if ($referenceNode['target'] == 'header' || $referenceNode['target'] == 'footer') {
            // not document targets

            $contents = $this->getWordContentByRels($referenceNode);

            if (count($contents) > 0) {
                $query = $this->getWordContentQuery($referenceNode);
                $contentElements = array();
                foreach ($contents as $content) {
                    $domDocument = $content['document'];
                    $domXpath = $content['documentXpath'];
                    $target = $content['target'];

                    $contentNodes = $domXpath->query($query);

                    if ($contentNodes->length > 0) {
                        $contentElements[] = array(
                            'elements' => $contentNodes,
                            'length' => $contentNodes->length,
                            'query' => $query,
                        );
                    }
                }

                return $contentElements;
            }
        } else {
            // default as document

            list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);
            $query = $this->getWordContentQuery($referenceNode);

            $contentNodes = $domXpath->query($query);

            return array(
                'elements' => $contentNodes,
                'length' => $contentNodes->length,
                'query' => $query,
            );
        }
    }

    /**
     * Return the text contents of a DOCXPath query
     *
     * @access public
     * @param array $referenceNode (if empty or null force append)
     * Keys and values:
     *     'type' (string) can be * (all, default value), bookmark, break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for links and lists), section, shape, table
     *     'contains' (string) for bookmark, list, paragraph (text, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     *     'target' (string) document (default), header, footer
     *     'reference' (array) for header and footer targets, allowed keys:
     *         'positions' (array) 1, 2... based on the sectPr contents order
     *         'sections' (array) 1, 2...
     *         'types' (array) 'first', 'even', 'default'
     * @return array
     * @throws Exception method not available
     */
    public function getWordContents($referenceNode)
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // choose the reference node based on content
        if (!isset($referenceNode['type'])) {
            $referenceNode['type'] = '*';
        }

        // manage types with more than one tag
        if ($referenceNode['type'] == 'bookmark') {
            $referenceNode['type'] = 'bookmarkStart';
        }

        // target
        if (!isset($referenceNode['target'])) {
            $referenceNode['target'] = 'document';
        }

        // reference
        if (!isset($referenceNode['reference'])) {
            $referenceNode['reference'] = array();
        }

        $contentNodesTextValues = array();

        if ($referenceNode['target'] == 'header' || $referenceNode['target'] == 'footer') {
            // not document targets

            $contents = $this->getWordContentByRels($referenceNode);

            if (count($contents) > 0) {
                $query = $this->getWordContentQuery($referenceNode);
                foreach ($contents as $content) {
                    $domDocument = $content['document'];
                    $domXpath = $content['documentXpath'];
                    $target = $content['target'];

                    $contentNodes = $domXpath->query($query);

                    foreach ($contentNodes as $contentNode) {
                        $contentNodesTextValues[] = $contentNode->textContent;
                    }
                }
            }
        } else {
            // default as document

            list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);
            $query = $this->getWordContentQuery($referenceNode);

            $contentNodes = $domXpath->query($query);

            if (count($contentNodes) > 0) {
                foreach ($contentNodes as $contentNode) {
                    $contentNodesTextValues[] = $contentNode->textContent;
                }
            }
        }

        return $contentNodesTextValues;
    }

    /**
     * Return file contents from the DOCX
     *
     * @access public
     * @param string $source Internal path
     * @return string or null if the file doesn't exist
     * @throws Exception method not available
     */
    public function getWordFiles($source) {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        $fileContent = null;

        if ($source) {
            $fileContent = $this->_zipDocx->getContent($source);
            if (!$fileContent) {
                $fileContent = null;
            }
        }

        return $fileContent;
    }

    /**
     * Return the styles used by contents of a DOCXPath query
     *
     * @access public
     * @param array $referenceNode (if empty or null force append)
     * Keys and values:
     *     'type' (string) can be chart, image, default, list, paragraph (also for links and lists), run, style, table, table-row, table-cell or a custom tag
     *     'contains' (string) for bookmark, list, paragraph (text, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     * @return array
     * @throws Exception method not available, missing type value
     */
    public function getWordStyles($referenceNode)
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        if (!isset($referenceNode['type'])) {
            PhpdocxLogger::logger('Set the type value.', 'fatal');
        }

        $contentNodesStyles = array();
        $contentNodesStylesIndex = 0;

        if ($referenceNode['type'] == 'default') {
            // default styles
            list($domStyle, $domStyleXpath) = $this->getWordContentDOM('style');
            $contentStylesNodes = $domStyleXpath->query('//w:style[@w:default="1"]');

            if ($contentStylesNodes->length > 0) {
                foreach ($contentStylesNodes as $contentStylesNode) {
                    $docxpathStyles = new DOCXPathStyles();
                    $docxpathStylesValues = $docxpathStyles->xmlParserStyle($contentStylesNode);

                    $contentNodesStyles[$contentNodesStylesIndex]['default'] = array(
                        'type' => $contentStylesNode->getAttribute('w:type'),
                        'val' => $contentStylesNode->getAttribute('w:styleId'),
                        'styles' => $docxpathStylesValues,
                    );

                    $contentNodesStylesIndex++;
                }
            }
        } else if ($referenceNode['type'] == 'style' && isset($referenceNode['contains'])) {
            // style
            list($domStyle, $domStyleXpath) = $this->getWordContentDOM('style');
            $contentStylesNodes = $domStyleXpath->query('//w:style[@w:styleId="'.$referenceNode['contains'].'"]');

            if ($contentStylesNodes->length > 0) {
                $docxpathStyles = new DOCXPathStyles();
                $docxpathStylesValues = $docxpathStyles->xmlParserStyle($contentStylesNodes->item(0));

                $contentNodesStyles[$contentNodesStylesIndex]['style'] = array(
                    'type' => $contentStylesNodes->item(0)->getAttribute('w:type'),
                    'val' => $contentStylesNodes->item(0)->getAttribute('w:styleId'),
                    'styles' => $docxpathStylesValues,
                );

                $contentNodesStylesIndex++;
            }
        } else {
            $target = 'document';
            list($domDocument, $domXpath) = $this->getWordContentDOM('document');
            $query = $this->getWordContentQuery($referenceNode);

            $contentNodes = $domXpath->query($query);

            if (count($contentNodes) > 0) {
                foreach ($contentNodes as $contentNode) {
                    if ($referenceNode['type'] == 'chart') {
                        // chart style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:drawing';
                        $drawingStyle = $nodeXPath->query($query, $contentNode);
                        if ($drawingStyle->length > 0) {
                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($drawingStyle->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['chart'] = array(
                                'type' => 'w:drawing',
                                'val' => 'w:drawing',
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        $contentNodesStylesIndex++;
                    }

                    if ($referenceNode['type'] == 'image') {
                        // image style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:drawing';
                        $drawingStyle = $nodeXPath->query($query, $contentNode);
                        if ($drawingStyle->length > 0) {
                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($drawingStyle->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['image'] = array(
                                'type' => 'w:drawing',
                                'val' => 'w:drawing',
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        $contentNodesStylesIndex++;
                    }

                    if ($referenceNode['type'] == 'list') {
                        // w:numPr style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:numPr';
                        $numPrStyle = $nodeXPath->query($query, $contentNode);
                        if ($numPrStyle->item(0) && $numPrStyle->item(0)->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'numId')->item(0)) {
                            $numValue = $numPrStyle->item(0)->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'numId')->item(0)->getAttribute('w:val');
                            if ($numPrStyle->length > 0) {
                                $docxpathStyles = new DOCXPathStyles();
                                $docxpathStylesValues = $docxpathStyles->xmlParserStyle($numPrStyle->item(0));

                                $contentNodesStyles[$contentNodesStylesIndex]['numPr'] = array(
                                    'type' => 'w:numPr',
                                    'val' => $numValue,
                                    'styles' => $docxpathStylesValues,
                                );
                            }
                        }

                        // numbering style
                        $domNumbering = new DOMDocument();
                        if (PHP_VERSION_ID < 80000) {
                            $optionEntityLoader = libxml_disable_entity_loader(true);
                        }
                        $domNumbering->loadXML($this->_wordNumberingT);
                        if (PHP_VERSION_ID < 80000) {
                            libxml_disable_entity_loader($optionEntityLoader);
                        }
                        $domNumberingXpath = new DOMXPath($domNumbering);
                        // get abstractNumId w:val
                        $domNumberingXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $contentNumberingNodes = $domNumberingXpath->query('//w:num[@w:numId="'.$numValue.'"]');
                        if ($contentNumberingNodes->item(0) && $contentNumberingNodes->item(0)->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'abstractNumId')->item(0)) {
                            $abstractNumIdVal = $contentNumberingNodes->item(0)->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'abstractNumId')->item(0)->getAttribute('w:val');
                            // get w:abstractNum
                            $contentNumberingAbstractNodes = $domNumberingXpath->query('//w:abstractNum[@w:abstractNumId="'.$abstractNumIdVal.'"]');
                            if ($contentNumberingAbstractNodes->length > 0) {
                                $docxpathStyles = new DOCXPathStyles();
                                $docxpathStylesValues = $docxpathStyles->xmlParserStyle($contentNumberingAbstractNodes->item(0));

                                $contentNodesStyles[$contentNodesStylesIndex]['numbering'] = array(
                                    'type' => 'numbering',
                                    'val' => $abstractNumIdVal,
                                    'styles' => $docxpathStylesValues,
                                );
                            }
                        }

                        $contentNodesStylesIndex++;
                    }

                    if ($referenceNode['type'] == 'paragraph' || $referenceNode['type'] == 'link' || $referenceNode['type'] == 'list') {
                        // paragraph style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:pStyle';
                        $pStyle = $nodeXPath->query($query, $contentNode);
                        if ($pStyle->length > 0) {
                            $pStyleName = $pStyle->item(0)->getAttribute('w:val');

                            // get styles from styles.xml
                            list($domStyle, $domStyleXpath) = $this->getWordContentDOM('style');
                            $contentStylesNodes = $domStyleXpath->query('//w:style[@w:styleId="'.$pStyleName.'" and @w:type="paragraph"]');

                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($contentStylesNodes->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['pStyle'] = array(
                                'type' => 'w:pStyle',
                                'val' => $pStyleName,
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        // w:pPr style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:pPr';
                        $pPrStyle = $nodeXPath->query($query, $contentNode);
                        if ($pPrStyle->length > 0) {
                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($pPrStyle->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['pPr'] = array(
                                'type' => 'w:pPr',
                                'val' => 'w:pPr',
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        $contentNodesStylesIndex++;
                    }

                    if ($referenceNode['type'] == 'run') {
                        // character style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:rStyle';
                        $rStyle = $nodeXPath->query($query, $contentNode);
                        if ($rStyle->length > 0) {
                            $rStyleName = $rStyle->item(0)->getAttribute('w:val');

                            // get styles from styles.xml
                            list($domStyle, $domStyleXpath) = $this->getWordContentDOM('style');
                            $contentStylesNodes = $domStyleXpath->query('//w:style[@w:styleId="'.$rStyleName.'" and @w:type="character"]');

                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($contentStylesNodes->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['rStyle'] = array(
                                'type' => 'w:rStyle',
                                'val' => $rStyleName,
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        // w:rPr style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:rPr';
                        $rPrStyle = $nodeXPath->query($query, $contentNode);
                        if ($rPrStyle->length > 0) {
                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($rPrStyle->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['rPr'] = array(
                                'type' => 'w:rPr',
                                'val' => 'w:rPr',
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        $contentNodesStylesIndex++;
                    }

                    if ($referenceNode['type'] == 'table') {
                        // table style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:tblStyle';
                        $tblStyle = $nodeXPath->query($query, $contentNode);
                        if ($tblStyle->length > 0) {
                            $tblStyleName = $tblStyle->item(0)->getAttribute('w:val');

                            // get styles from styles.xml
                            list($domStyle, $domStyleXpath) = $this->getWordContentDOM('style');
                            $contentStylesNodes = $domStyleXpath->query('//w:style[@w:styleId="'.$tblStyleName.'" and @w:type="table"]');

                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($contentStylesNodes->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['tblStyle'] = array(
                                'type' => 'w:tblStyle',
                                'val' => $tblStyleName,
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        // w:tblPr style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:tblPr';
                        $tblPrStyle = $nodeXPath->query($query, $contentNode);
                        if ($tblPrStyle->length > 0) {
                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($tblPrStyle->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['tblPr'] = array(
                                'type' => 'w:tblPr',
                                'val' => 'w:tblPr',
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        // w:tblGrid style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:tblGrid';
                        $tblGridStyle = $nodeXPath->query($query, $contentNode);
                        if ($tblGridStyle->length > 0) {
                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($tblGridStyle->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['tblGrid'] = array(
                                'type' => 'w:tblGrid',
                                'val' => 'w:tblGrid',
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        $contentNodesStylesIndex++;
                    }

                    if ($referenceNode['type'] == 'table-row') {
                        // table row style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:trPr';
                        $trPrStyle = $nodeXPath->query($query, $contentNode);
                        if ($trPrStyle->length > 0) {
                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($trPrStyle->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['trPr'] = array(
                                'type' => 'w:trPr',
                                'val' => 'w:trPr',
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        $contentNodesStylesIndex++;
                    }

                    if ($referenceNode['type'] == 'table-cell') {
                        // table cell style
                        $nodeXPath = new DOMXPath($contentNode->ownerDocument);
                        $nodeXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $query = './/w:tcPr';
                        $tcPrStyle = $nodeXPath->query($query, $contentNode);
                        if ($tcPrStyle->length > 0) {
                            $docxpathStyles = new DOCXPathStyles();
                            $docxpathStylesValues = $docxpathStyles->xmlParserStyle($tcPrStyle->item(0));

                            $contentNodesStyles[$contentNodesStylesIndex]['tcPr'] = array(
                                'type' => 'w:tcPr',
                                'val' => 'w:tcPr',
                                'styles' => $docxpathStylesValues,
                            );
                        }

                        $contentNodesStylesIndex++;
                    }

                }
            }
        }

        return $contentNodesStyles;
    }

    /**
     * Inserts new headers and/or footers from a Word file
     *
     * @param string|DOCXStructure $path. Path to the docx from which we wish to import the header and/or footer
     * @param string $type. Declares if we want to import only the header, only the footer or both.
     * Values: header, footer, headerAndFooter (default value)
     * @param array $options
     * Keys and values:
     *      setDefault (bool) : false as default. If true, set as default the imported content
     */
    public function importHeadersAndFooters($path, $type = 'headerAndFooter', $options = array())
    {
        switch ($type) {
            case 'headerAndFooter':
                $this->removeHeadersAndFooters();
                break;
            case 'header':
                $this->removeHeaders();
                break;
            case 'footer':
                $this->removeFooters();
                break;
        }

        if ($path instanceof DOCXStructure) {
            $baseHeadersFooters = $path;
        } else {
            $baseHeadersFooters = new DOCXStructure();
            $baseHeadersFooters->parseDocx($path);
        }

        // extract the different roles: default, even or first played by the different headers and footers.
        // In order to do that we should first parse the node sectPr from the document.xml file
        $docHeadersFootersContent = $this->getFromZip('word/document.xml', 'DOMDocument', $baseHeadersFooters);

        // extract the first sectPr element in the document assuming there is only one section
        $docSectPr = $docHeadersFootersContent->getElementsByTagName('sectPr')->item(0);

        $headerTypes = array();
        $footerTypes = array();
        $titlePg = false;
        $extraSections = false;
        foreach ($docSectPr->childNodes as $value) {
            if (isset($options['setDefault']) && $options['setDefault']) {
                $value->setAttribute('w:type', 'default');
            }
            if ($value->nodeName == 'w:headerReference') {
                $headerTypes[$value->getAttribute('r:id')] = $value->getAttribute('w:type');
            } else if ($value->nodeName == 'w:footerReference') {
                $footerTypes[$value->getAttribute('r:id')] = $value->getAttribute('w:type');
            }
        }
        // check if the first and even headers and footers are shown in the original Word document
        $titlePg = false;
        if ($docHeadersFootersContent->getElementsByTagName('titlePg')->length > 0) {
            $titlePg = true;
        }
        if (isset($options['setDefault']) && $options['setDefault']) {
            $titlePg = false;
        }

        $settingsHeadersFootersContent = $this->getFromZip('word/settings.xml', 'DOMDocument', $baseHeadersFooters);

        if ($settingsHeadersFootersContent->getElementsByTagName('evenAndOddHeaders')->length > 0) {
            $this->generateSetting('w:evenAndOddHeaders');
        }

        // parse word/_rels/document.xml.rels
        $wordHeadersFootersRelsT = $this->getFromZip('word/_rels/document.xml.rels', 'DOMDocument', $baseHeadersFooters);
        $relationships = $wordHeadersFootersRelsT->getElementsByTagName('Relationship');

        $counter = $relationships->length - 1;

        $relsHeader = array();
        $relsFooter = array();

        for ($j = $counter; $j > -1; $j--) {
            $rId = $relationships->item($j)->getAttribute('Id');
            $completeType = $relationships->item($j)->getAttribute('Type');
            $target = $relationships->item($j)->getAttribute('Target');
            $completeTypeExplode = explode('/', $completeType);
            $myType = array_pop($completeTypeExplode);

            switch ($myType) {
                case 'header':
                    $relsHeader[$rId] = $target;
                    break;
                case 'footer':
                    $relsFooter[$rId] = $target;
                    break;
            }
        }
        // in case there are more sectPr within $this->documentC include the corresponding elements
        $domDocument = $this->getDOMDocx();
        $sections = $domDocument->getElementsByTagName('sectPr');

        // start the looping over the $relsHeader and/or $relsFooter arrays
        if ($type == 'headerAndFooter' || $type == 'header') {
            foreach ($relsHeader as $key => $value) {
                // first check if there is a rels file for each header
                if ($this->getFromZip('word/_rels/' . $value . '.rels', 'DOMDocument', $baseHeadersFooters)) {
                    // parse the corresponding rels file to copy and rename the images included in the header
                    $wordHeadersRelsT = $this->getFromZip('word/_rels/' . $value . '.rels', 'DOMDocument', $baseHeadersFooters);
                    $relations = $wordHeadersRelsT->getElementsByTagName('Relationship');

                    $countrels = $relations->length - 1;

                    for ($j = $countrels; $j > -1; $j--) {
                        $completeType = $relations->item($j)->getAttribute('Type');
                        $target = $relations->item($j)->getAttribute('Target');
                        $completeTypeExplode = explode('/', $completeType);
                        $myType = array_pop($completeTypeExplode);

                        switch ($myType) {
                            case 'hyperlink':
                                // copy the header rels in the base template
                                $header = $wordHeadersRelsT->saveXML();

                                $this->saveToZip($header, 'word/_rels/' . $value . '.rels');
                                break;
                            case 'image':
                                $refExtensionExplode = explode('.', $target);
                                $refExtension = array_pop($refExtensionExplode);
                                $refImage = 'media/image' . uniqid(mt_rand(999, 9999)) . '.' . $refExtension;
                                // change the attibute to the new name
                                $relations->item($j)->setAttribute('Target', $refImage);
                                // copy the image in the base template with the new name
                                $image = $this->getFromZip('word/' . $target, 'string', $baseHeadersFooters);
                                $this->saveToZip($image, 'word/' . $refImage);
                                // copy the associated rels file
                                $this->saveToZip($wordHeadersRelsT, 'word/_rels/' . $value . '.rels');
                                // make sure that the corresponding image types are included in [Content_Types].xml
                                $imageTypeFound = false;
                                foreach ($this->_contentTypeT->documentElement->childNodes as $node) {
                                    if ($node->nodeName == 'Default' && $node->getAttribute('Extension') == $refExtension) {
                                        $imageTypeFound = true;
                                    }
                                }
                                if (!$imageTypeFound) {
                                    $newDefaultNode = '<Default Extension="' . $refExtension . '" ContentType="image/' . $refExtension . '" />';
                                    $newDefault = $this->_contentTypeT->createDocumentFragment();
                                    $newDefault->appendXML($newDefaultNode);
                                    $baseDefaultNode = $this->_contentTypeT->documentElement;
                                    $baseDefaultNode->appendChild($newDefault);
                                }
                                break;
                        }
                    }
                }

                // copy the corresponding header xml files
                $file = $this->getFromZip('word/' . $value, 'string', $baseHeadersFooters);
                $this->saveToZip($file, 'word/' . $value);
                // modify the /_rels/document.xml.rels of the base template to include the new element
                $newId = uniqid(mt_rand(999, 9999));
                $newHeaderNode = '<Relationship Id="rId';
                $newHeaderNode .= $newId . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/header"';
                $newHeaderNode .= ' Target="' . $value . '" />';
                $newNode = $this->_wordRelsDocumentRelsT->createDocumentFragment();
                $newNode->appendXML($newHeaderNode);
                $baseNode = $this->_wordRelsDocumentRelsT->documentElement;
                $baseNode->appendChild($newNode);

                // as well as the section DOMNode
                $newSectNode = '<w:headerReference w:type="' . $headerTypes[$key] . '" r:id="rId' . $newId . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"/>';
                $sectNode = $this->_sectPr->createDocumentFragment();
                $sectNode->appendXML($newSectNode);
                $refNode = $this->_sectPr->documentElement->childNodes->item(0);
                $refNode->parentNode->insertBefore($sectNode, $refNode);
                // and include the corresponding <Override> in [Content_Types].xml
                $newOverrideNode = '<Override PartName="/word/' . $value . '" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml" />';
                $newOverride = $this->_contentTypeT->createDocumentFragment();
                $newOverride->appendXML($newOverrideNode);
                $baseOverrideNode = $this->_contentTypeT->documentElement;
                $baseOverrideNode->appendChild($newOverride);


                foreach ($sections as $section) {
                    $extraSections = true;
                    $refNode = $section->childNodes->item(0);
                    $sectNode = $domDocument->createDocumentFragment();
                    $sectNode->appendXML($newSectNode);
                    $refNode->parentNode->insertBefore($sectNode, $refNode);
                }
            }
        }
        if ($type == 'headerAndFooter' || $type == 'footer') {
            foreach ($relsFooter as $key => $value) {
                // check if there is a rels file for each footer
                if ($this->getFromZip('word/_rels/' . $value . '.rels', 'DOMDocument', $baseHeadersFooters)) {
                    // parse the corresponding rels file to copy and rename the images included in the footer
                    $wordFootersRelsT = $this->getFromZip('word/_rels/' . $value . '.rels', 'DOMDocument', $baseHeadersFooters);
                    $relations = $wordFootersRelsT->getElementsByTagName('Relationship');

                    $countrels = $relations->length - 1;

                    for ($j = $countrels; $j > -1; $j--) {
                        $completeType = $relations->item($j)->getAttribute('Type');
                        $target = $relations->item($j)->getAttribute('Target');
                        $completeTypeExplode = explode('/', $completeType);
                        $myType = array_pop($completeTypeExplode);

                        switch ($myType) {
                            case 'hyperlink':
                                // copy the footer rels in the base template
                                $footer = $wordFootersRelsT->saveXML();

                                $this->saveToZip($footer, 'word/_rels/' . $value . '.rels');
                                break;
                            case 'image':
                                $refExtension = array_pop(explode('.', $target));
                                $refImage = 'media/image' . uniqid(mt_rand(999, 9999)) . '.' . $refExtension;
                                // change the attibute to the new name
                                $relations->item($j)->setAttribute('Target', $refImage);
                                // copy the image in the base template with the new name
                                $image = $this->getFromZip('word/' . $target, 'string', $baseHeadersFooters);
                                $this->saveToZip($image, 'word/' . $refImage);
                                // copy the associated rels file
                                $this->saveToZip($wordFootersRelsT, 'word/_rels/' . $value . '.rels');
                                // make sure that the corresponding image types are included in [Content_Types].xml
                                $imageTypeFound = false;
                                foreach ($this->_contentTypeT->documentElement->childNodes as $node) {
                                    if ($node->nodeName == 'Default' && $node->getAttribute('Extension') == $refExtension) {
                                        $imageTypeFound = true;
                                    }
                                }
                                if (!$imageTypeFound) {
                                    $newDefaultNode = '<Default Extension="' . $refExtension . '" ContentType="image/' . $refExtension . '" />';
                                    $newDefault = $this->_contentTypeT->createDocumentFragment();
                                    $newDefault->appendXML($newDefaultNode);
                                    $baseDefaultNode = $this->_contentTypeT->documentElement;
                                    $baseDefaultNode->appendChild($newDefault);
                                }
                                break;
                        }
                    }
                }

                // copy the corresponding footer xml files
                $file = $this->getFromZip('word/' . $value, 'string', $baseHeadersFooters);
                $this->saveToZip($file, 'word/' . $value);
                // modify the /_rels/document.xml.rels of the base template to include the new element
                $newId = uniqid(mt_rand(999, 9999));
                $newFooterNode = '<Relationship Id="rId';
                $newFooterNode .= $newId . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/footer"';
                $newFooterNode .= ' Target="' . $value . '" />';
                $newNode = $this->_wordRelsDocumentRelsT->createDocumentFragment();
                $newNode->appendXML($newFooterNode);
                $baseNode = $this->_wordRelsDocumentRelsT->documentElement;
                $baseNode->appendChild($newNode);

                // as well as the section DOMNode
                $newSectNode = '<w:footerReference w:type="' . $footerTypes[$key] . '" r:id="rId' . $newId . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"/>';
                $sectNode = $this->_sectPr->createDocumentFragment();
                $sectNode->appendXML($newSectNode);
                $refNode = $this->_sectPr->documentElement->childNodes->item(0);
                $refNode->parentNode->insertBefore($sectNode, $refNode);

                // include the corresponding <Override> in [Content_Types].xml
                $newOverrideNode = '<Override PartName="/word/' . $value . '" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml" />';
                $newOverride = $this->_contentTypeT->createDocumentFragment();
                $newOverride->appendXML($newOverrideNode);
                $baseOverrideNode = $this->_contentTypeT->documentElement;
                $baseOverrideNode->appendChild($newOverride);

                foreach ($sections as $section) {
                    $extraSections = true;
                    $refNode = $section->childNodes->item(0);
                    $sectNode = $domDocument->createDocumentFragment();
                    $sectNode->appendXML($newSectNode);
                    $refNode->parentNode->insertBefore($sectNode, $refNode);
                }
            }
        }
        $stringDoc = $domDocument->saveXML();
        $bodyTag = explode('<w:body>', $stringDoc);
        if (isset($bodyTag[1])) {
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        }

        if ($titlePg) {
            $this->generateTitlePg($extraSections);
        }
    }

    /**
     * Imports an existing chart style (colors and style XML files) from an existing docx document
     *
     * @access public
     * @param string $path Must be a valid path to an existing .docx, .dotx o .docm document
     * @param string $position Chart position in the DOCX, from 1
     * @param string $name New name of the style
     * @throws Exception method not available, error opening the file
     */
    public function importChartStyle($path, $position, $name)
    {
        if (!file_exists(dirname(__FILE__) . '/ThemeCharts.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // the first element is 1, not 0
        if ($position == '0') {
            $position = '1';
        }

        $chartStyles = new ZipArchive();
        try {
            $openStyle = $chartStyles->open($path);
            if ($openStyle !== true) {
                throw new Exception('Error while opening the style template: check the path');
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }

        $document = $this->getFromZip('word/document.xml', 'DOMDocument', $chartStyles);

        $documentXPath = new DOMXPath($document);
        $documentXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $documentXPath->registerNamespace('c', 'http://schemas.openxmlformats.org/drawingml/2006/chart');
        $query = '(//w:drawing//c:chart)[' . $position . ']';
        $chart = $documentXPath->query($query);
        if ($chart->length > 0) {
            $chartId = $chart->item(0)->getAttribute('r:id');

            // get color and styles files path
            $documentRels = $this->getFromZip('word/_rels/document.xml.rels', 'DOMDocument', $chartStyles);
            $documentRelsXPath = new DOMXPath($documentRels);
            $documentRelsXPath->registerNamespace('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');
            $queryRelationship = '//xmlns:Relationship[@Id="' . $chartId . '"]';
            $chartRelationship = $documentRelsXPath->query($queryRelationship);
            if ($chartRelationship->length > 0) {
                $chartPath = $chartRelationship->item(0)->getAttribute('Target');

                $documentRelsChart = $this->getFromZip('word/' . str_replace('charts/', 'charts/_rels/', $chartPath) . '.rels', 'DOMDocument', $chartStyles);
                $documentRelsChartXPath = new DOMXPath($documentRelsChart);
                $documentRelsChartXPath->registerNamespace('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');
                $queryColorRelationship = '//xmlns:Relationship[@Type="http://schemas.microsoft.com/office/2011/relationships/chartColorStyle"]';
                $queryStyleRelationship = '//xmlns:Relationship[@Type="http://schemas.microsoft.com/office/2011/relationships/chartStyle"]';

                $colorContent = '';
                $styleContent = '';
                $chartColorRelationship = $documentRelsChartXPath->query($queryColorRelationship);
                if ($chartColorRelationship->length > 0) {
                    $colorContent = $this->getFromZip('word/charts/' . $chartColorRelationship->item(0)->getAttribute('Target'), 'DOMDocument', $chartStyles)->saveXML();
                }
                $chartStyleRelationship = $documentRelsChartXPath->query($queryStyleRelationship);
                if ($chartStyleRelationship->length > 0) {
                    $styleContent = $this->getFromZip('word/charts/' . $chartStyleRelationship->item(0)->getAttribute('Target'), 'DOMDocument', $chartStyles)->saveXML();
                }

                // storage both files to be used with the addChart method
                $this->_parsedStylesChart[$name] = array(
                    'colors' => $colorContent,
                    'style' => $styleContent,
                );
            }
        } else {
            PhpdocxLogger::logger('The requested chart could not be found.', 'fatal');
        }
        $chartStyles->close();
    }

    /**
     * Imports contents from a DOCX
     *
     * @access public
     * @param string $document|DOCXStructure path or DOCXStructure of the document that includes the contents to be imported
     * @param array $referenceNode
     * Keys and values:
     *     'type' (string) can be * (all, default value), bookmark, break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for links and lists), section, shape, table
     *     'contains' (string) for bookmark, list, paragraph (text, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     */
    public function importContents($document, $referenceNode)
    {
        if (file_exists(dirname(__FILE__) . '/DOCXStructureTemplate.php') && $document instanceof DOCXStructure) {
            // use in-memory DOCX
            $documentInMemory = $document;
        } else {
            // use a file, load it as in-memory DOCX
            $documentInMemory = new DOCXStructure();
            $documentInMemory->parseDocx($document);
        }

        // use in-memory DOCX to avoid creating external files

        // keep the current self::$returnDocxStructure value to set it after the method has finished
        $originalValue = self::$returnDocxStructure;

        self::$returnDocxStructure = true;

        // insert a new placeholder at the end the current DOCX.
        // This placeholder will be used to know where the imported DOCX starts
        $this->addText('IMPORTED_CONTENTS_PHPDOCX');

        // merge the current document and the new one
        $merge = new MultiMerge();
        $documentStructure = $merge->mergeDocx($this->createDocx(null), array($documentInMemory), 'output.docx', array());

        // load the document of the DOCX to be imported as DOM and Xpath
        $documentMainContent = $documentStructure->getContent('word/document.xml');
        $domDocument = new DOMDocument();
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $domDocument->loadXML($documentMainContent);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }

        $domXpath = new DOMXPath($domDocument);
        $domXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $domXpath->registerNamespace('wp', 'http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing');
        $domXpath->registerNamespace('a', 'http://schemas.openxmlformats.org/drawingml/2006/main');
        $domXpath->registerNamespace('c', 'http://schemas.openxmlformats.org/drawingml/2006/chart');
        $domXpath->registerNamespace('pic', 'http://schemas.openxmlformats.org/drawingml/2006/picture');

        // move the selected nodes before $IMPORTED_CONTENTS_PHPDOCX$
        // get the referenceNode
        $referencedWordContentQuery = $this->getWordContentQuery($referenceNode);
        // clean the query removing the body selector
        $referencedWordContentQuery = str_replace(array('(//w:body/'), '', $referencedWordContentQuery);
        $referencedWordContentQuery = str_replace(array('//w:body/'), '', $referencedWordContentQuery);
        $referencedWordContentQuery = str_replace(array(')['), '[', $referencedWordContentQuery);
        $contentNodesReferencedWordContent = $domXpath->query('//w:body//w:p[w:r/w:t[text()[contains(.,"IMPORTED_CONTENTS_PHPDOCX")]]][1]/following-sibling::' . $referencedWordContentQuery);

        // get the referenceNodeTo
        $contentNodesReferencedToWordContent = $domXpath->query('//w:body//w:p[w:r/w:t[text()[contains(.,"IMPORTED_CONTENTS_PHPDOCX")]]][1]');

        // copy the contents to be imported before IMPORTED_CONTENTS_PHPDOCX
        foreach ($contentNodesReferencedWordContent as $contentNodeReferencedWordContent) {
            $contentNodeReferencedWordContent->parentNode->insertBefore($contentNodeReferencedWordContent, $contentNodesReferencedToWordContent->item(0));
        }

        // remove all contents after IMPORTED_CONTENTS_PHPDOCX but the last section, as they are not needed
        $contentNodesReferencedWordContent = $domXpath->query('//w:body//w:p[w:r/w:t[text()[contains(.,"IMPORTED_CONTENTS_PHPDOCX")]]][1]/following-sibling::*');
        $i = 1;
        foreach ($contentNodesReferencedWordContent as $contentNodeReferencedWordContent) {
            if ($i < $contentNodesReferencedWordContent->length) {
                $contentNodeReferencedWordContent->parentNode->removeChild($contentNodeReferencedWordContent);
            }
            $i++;
        }

        // remove IMPORTED_CONTENTS_PHPDOCX
        $contentNodesReferencedWordContent = $domXpath->query('//w:body//w:p[w:r/w:t[text()[contains(.,"IMPORTED_CONTENTS_PHPDOCX")]]][1]');
        foreach ($contentNodesReferencedWordContent as $contentNodeReferencedWordContent) {
            $contentNodeReferencedWordContent->parentNode->removeChild($contentNodeReferencedWordContent);
        }

        $documentStructure->addContent('word/document.xml', $domDocument->saveXML());

        if (get_class($this) == 'CreateDocx') {
            // regenerate the current document using the constructor
            $this->__construct(PHPDOCX_BASE_TEMPLATE, $documentStructure);
        } else {
            $this->__construct($documentStructure);
        }

        // set self::$returnDocxStructure value to its initial value
        self::$returnDocxStructure = $originalValue;
    }

    /**
     * Imports an existing list style from an existing docx document
     *
     * @access public
     * @param string $path Must be a valid path to an existing .docx, .dotx o .docm document
     * @param int $id The id of the style you want to import. You may obtain the id with the help of the parseStyle method
     * @param string $name New name of the style
     * @throws Exception list style can't be found
     */
    public function importListStyle($path, $id, $name)
    {
        if ($path instanceof DOCXStructure) {
            $listStyles = $path;
        } else {
            $listStyles = new DOCXStructure();
            $listStyles->parseDocx($path);
        }

        $externalNumbering = new DOMDocument();
        $externalNumbering->loadXML($listStyles->getContent('word/numbering.xml'));

        $numXPath = new DOMXPath($externalNumbering);
        $numXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $query = '//w:num[@w:numId = "' . $id . '"]';
        $numbering = $numXPath->query($query);
        if ($numbering->length > 0) {
            $abstractNumId = $numbering->item(0)->getElementsByTagName('abstractNumId')->item(0)->getAttribute('w:val');
        } else {
            PhpdocxLogger::logger('The requested list style could not be found.', 'fatal');
        }
        $query2 = '//w:abstractNum[@w:abstractNumId = "' . $abstractNumId . '"]';
        $listStyleNode = $numXPath->query($query2)->item(0);
        $listStyleXML = $listStyleNode->ownerDocument->saveXML($listStyleNode);
        $listId = self::uniqueNumberId(999, 32766);
        $originalAbstractNumId = self::uniqueNumberId(999, 32766);
        // check if the style includes a numStyleLink tag to apply their properties
        $numStyleLinkNodes = $listStyleNode->getElementsByTagName('numStyleLink');
        if ($numStyleLinkNodes->length > 0) {
            $styleValue = $numStyleLinkNodes->item(0)->getAttribute('w:val');
            $queryStyleValue = '//w:abstractNum/w:styleLink[@w:val="'.$styleValue.'"]';
            $abstractStyleNode = $numXPath->query($queryStyleValue);
            if ($abstractStyleNode->length > 0) {
                $abstractStyleLvlNodes = $abstractStyleNode->item(0)->parentNode->getElementsByTagName('lvl');
                if ($abstractStyleLvlNodes->length > 0) {
                    // add the level styles to the new list style to use them instead of the numStyleLink value
                    $keepNodes = array();
                    foreach ($abstractStyleLvlNodes as $abstractStyleLvlNode) {
                        $keepNodes[] = clone($abstractStyleLvlNode);
                    }
                    // insert the nodes
                    foreach ($keepNodes as $keepNode) {
                        $numStyleLinkNodes->item(0)->parentNode->appendChild($keepNode);
                    }
                    // remove numStyleLink
                    $numStyleLinkNodes->item(0)->parentNode->removeChild($numStyleLinkNodes->item(0));
                }
                $listStyleXML = $listStyleNode->ownerDocument->saveXML($listStyleNode);
            }
        }
        $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, $listStyleXML, $listId, $abstractNumId, true);
        $listStyleXML = str_replace('<w:abstractNum w:abstractNumId="'.$listId.'"', '<w:abstractNum w:abstractNumId="' . $abstractNumId . '"', $listStyleXML);
        self::$customLists[$name]['id'] = $listId;
        self::$customLists[$name]['wordML'] = $listStyleXML;
    }

    /**
     *
     * Inserts a new numbering style.
     *
     * @param string $numberingsXML the numberings.xml that we wish to modify
     * @param string $newNumbering the new numbering style we wish to add
     * @param string $numberId a unique integer tha determines the numId
     * @param string $originalAbstractNumId a unique integer that determines the abstractNumId
     * @param bool $removeNsid
     */
    public function importSingleNumbering($numberingsXML, $newNumbering, $numberId, $originalAbstractNumId = '', $removeNsid = false)
    {
        // insert the $newNumbering into $numberingsXML
        $myNumbering = new DOMDocument();
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $myNumbering->loadXML($numberingsXML);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }

        // check if there's content in the numbering. Add a base it there's no child
        if ($myNumbering->documentElement->firstChild === null) {
            $this->_wordNumberingT = $this->generateBaseWordNumbering();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $myNumbering->loadXML($this->_wordNumberingT);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
        }

        // modify the w:abstractNumId atribute
        $newNumbering = str_replace('w:abstractNumId="' . $originalAbstractNumId . '"', 'w:abstractNumId="' . $numberId . '"', $newNumbering);
        $newNumbering = str_replace('w:tplc=""', 'w:tplc="' . rand(10000000, 99999999) . '"', $newNumbering);
        $new = $myNumbering->createDocumentFragment();
        $prevValueLibXmlInternalErrors = libxml_use_internal_errors(true);
        $new->appendXML($newNumbering);
        libxml_clear_errors();
        libxml_use_internal_errors($prevValueLibXmlInternalErrors);
        $base = $myNumbering->documentElement->firstChild;
        $base->parentNode->insertBefore($new, $base);

        if ($removeNsid) {
            $numXPath = new DOMXPath($myNumbering);
            $numXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
            $nsidQuery = '//w:nsid | //w:tmpl';
            $nsidNodes = $numXPath->query($nsidQuery);
            foreach ($nsidNodes as $node) {
                $node->parentNode->removeChild($node);
            }
        }

        $numberingsXML = $myNumbering->saveXML();

        // include the relationship
        $newNum = '<w:num w:numId="' . $numberId . '"><w:abstractNumId w:val="' . $numberId . '" /></w:num>';
        // check if there is a w:numIdMacAtCleanup element
        if (strpos($numberingsXML, 'w:numIdMacAtCleanup') !== false) {
            $numberingsXML = str_replace('<w:numIdMacAtCleanup', $newNum . '<w:numIdMacAtCleanup', $numberingsXML);
        } else {
            $numberingsXML = str_replace('</w:numbering>', $newNum . '</w:numbering>', $numberingsXML);
        }

        return $numberingsXML;
    }

    /**
     * Imports an existing style sheet from an existing docx document.
     *
     * @access public
     * @param string|DOCXStructure $path. Must be a valid path to an existing .docx, .dotx o .docm document
     * @param string $type. You may choose 'replace' (overwrites the current styles) or 'merge' (adds the selected styles)
     * @param array $myStyles. A list of specific styles to be merged. If it is empty or the choosen type is 'replace' it will be ignored.
     * @param string $styleIdentifier can be styleName or styleID
     * @throws Exception error opening the file
     */
    public function importStyles($path, $type = 'replace', $myStyles = array(), $styleIdentifier = 'styleName')
    {
        if ($path instanceof DOCXStructure) {
            $zipStyles = $path;
        } else {
            $zipStyles = new DOCXStructure();
            $zipStyles->parseDocx($path);
        }

        if ($type == 'replace') {
            // overwrite the original styles file
            $this->_wordStylesT = new DOMDocument();
            $this->_wordStylesT->loadXML($zipStyles->getContent('word/styles.xml'));

            // in order not to loose certain styles needed for certain PHPDOCX methods, merge them
            $this->importStyles(PHPDOCX_BASE_TEMPLATE, 'PHPDOCXStyles');
        } else {
            if ($type == 'PHPDOCXStyles') {
                $newStyles = OOXMLResources::$PHPDOCXStyles;
            } else {
                // first extract the new styles from the external docx
                try {
                    $newStyles = $zipStyles->getContent('word/styles.xml');
                    if (!$newStyles) {
                        throw new Exception('Error while extracting the styles from the external docx');
                    }
                } catch (Exception $e) {
                    PhpdocxLogger::logger($e->getMessage(), 'fatal');
                }
            }

            // parse the different styles via XPath
            $newStylesDoc = new DOMDocument();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $newStylesDoc->loadXML($newStyles);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
            $stylesXpath = new DOMXPath($newStylesDoc);
            $stylesXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
            $queryStyle = '//w:style';
            $styleNodes = $stylesXpath->query($queryStyle);

            // search for linked styles and basedOn styles
            if ($type == 'merge' && count($myStyles) > 0) {
                foreach ($myStyles as $singleStyle) {
                    if ($styleIdentifier == 'styleID') {
                        $query = '//w:style[@w:styleId="' . $singleStyle . '"]/w:basedOn | //w:style[@w:styleId="' . $singleStyle . '"]/w:link | //w:style[@w:styleId="' . $singleStyle . '"]';
                        $linkedNodes = $stylesXpath->query($query);
                        foreach ($linkedNodes as $linked) {
                            $myStyles[] = $linked->getAttribute('w:val');
                        }
                    } else if ($styleIdentifier == 'styleName') {
                        $query = '//w:style[w:name[@w:val="' . $singleStyle . '"]]/w:basedOn | //w:style[w:name[@w:val="' . $singleStyle . '"]]/w:link | //w:style[@w:name="' . $singleStyle . '"]';
                        $linkedNodes = $stylesXpath->query($query);
                        foreach ($linkedNodes as $linked) {
                            $linkedID = $linked->getAttribute('w:val');
                            $query = '//w:style[@w:styleId="' . $linkedID . '"]/w:name';
                            $nodeNames = $stylesXpath->query($query);
                            if ($nodeNames->length > 0) {
                                $myStyles[] = $nodeNames->item(0)->getAttribute('w:val');
                            }
                        }
                    }
                }
            }

            // get the original styles as a DOMDocument
            $baseNode = $this->_wordStylesT->documentElement;
            $stylesDocumentXPath = new DOMXPath($this->_wordStylesT);
            $stylesDocumentXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
            $query = '//w:style';
            $originalNodes = $stylesDocumentXPath->query($query);

            // insert the new styles at the end of the styles.xml
            foreach ($styleNodes as $node) {
                // check if the style has a numId to be added
                $numIdNode = $node->getElementsByTagName('numId');
                if ($numIdNode->length > 0) {
                    $numId = $numIdNode->item(0)->getAttribute('w:val');
                    // import and add the numbering
                    $externalNumbering = new DOMDocument();
                    $externalNumbering->loadXML($zipStyles->getContent('word/numbering.xml'));
                    $numXPath = new DOMXPath($externalNumbering);
                    $numXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                    $query = '//w:num[@w:numId = "' . $numId . '"]';
                    $numbering = $numXPath->query($query);
                    if ($numbering->length > 0) {
                        $abstractNumId = $numbering->item(0)->getElementsByTagName('abstractNumId')->item(0)->getAttribute('w:val');
                        $query2 = '//w:abstractNum[@w:abstractNumId = "' . $abstractNumId . '"]';
                        $listStyleNode = $numXPath->query($query2)->item(0);
                        $listStyleXML = $listStyleNode->ownerDocument->saveXML($listStyleNode);
                        $listId = self::uniqueNumberId(999, 32766);
                        $originalAbstractNumId = self::uniqueNumberId(999, 32766);
                        // check if the style includes a numStyleLink tag to apply their properties
                        $numStyleLinkNodes = $listStyleNode->getElementsByTagName('numStyleLink');
                        if ($numStyleLinkNodes->length > 0) {
                            $styleValue = $numStyleLinkNodes->item(0)->getAttribute('w:val');
                            $queryStyleValue = '//w:abstractNum/w:styleLink[@w:val="'.$styleValue.'"]';
                            $abstractStyleNode = $numXPath->query($queryStyleValue);
                            if ($abstractStyleNode->length > 0) {
                                $abstractStyleLvlNodes = $abstractStyleNode->item(0)->parentNode->getElementsByTagName('lvl');
                                if ($abstractStyleLvlNodes->length > 0) {
                                    // add the level styles to the new list style to use them instead of the numStyleLink value
                                    $keepNodes = array();
                                    foreach ($abstractStyleLvlNodes as $abstractStyleLvlNode) {
                                        $keepNodes[] = clone($abstractStyleLvlNode);
                                    }
                                    // insert the nodes
                                    foreach ($keepNodes as $keepNode) {
                                        $numStyleLinkNodes->item(0)->parentNode->appendChild($keepNode);
                                    }
                                    // remove numStyleLink
                                    $numStyleLinkNodes->item(0)->parentNode->removeChild($numStyleLinkNodes->item(0));
                                }
                                $listStyleXML = $listStyleNode->ownerDocument->saveXML($listStyleNode);
                            }
                        }
                        $this->_wordNumberingT = $this->importSingleNumbering($this->_wordNumberingT, $listStyleXML, $listId, $abstractNumId);
                        $this->_wordNumberingT = str_replace('<w:abstractNum w:abstractNumId="0"', '<w:abstractNum w:abstractNumId="' . $listId . '"', $this->_wordNumberingT);
                        $listStyleXML = str_replace('<w:abstractNum w:abstractNumId="0"', '<w:abstractNum w:abstractNumId="' . $originalAbstractNumId . '"', $listStyleXML);
                        if (!isset($name)) {
                            $name = 'nl' . $listId;
                        }
                        self::$customLists[$name]['id'] = $listId;
                        self::$customLists[$name]['wordML'] = $listStyleXML;
                        $numIdNode->item(0)->setAttribute('w:val', $listId);
                    }
                }

                // in order to avoid duplicated Ids we first remove from the
                // original styles.xml any duplicity with the new ones
                foreach ($originalNodes as $oldNode) {
                    if ($styleIdentifier == 'styleID') {
                        if ($oldNode->getAttribute('w:styleId') == $node->getAttribute('w:styleId') && in_array($oldNode->getAttribute('w:styleId'), $myStyles)) {
                            $oldNode->parentNode->removeChild($oldNode);
                        }
                    } else {
                        $oldName = $oldNode->getElementsByTagName('name');
                        foreach ($oldName as $myNode) {
                            $myName = $myNode->getAttribute('w:val');
                            if ($oldNode->getAttribute('w:styleId') == $node->getAttribute('w:styleId') && in_array($myName, $myStyles)) {
                                $oldNode->parentNode->removeChild($oldNode);
                            }
                        }
                    }
                }
                if (count($myStyles) > 0) {
                    // insert the selected styles
                    if ($styleIdentifier == 'styleID') {
                        if (in_array($node->getAttribute('w:styleId'), $myStyles)) {
                            $insertNode = $this->_wordStylesT->importNode($node, true);
                            $baseNode->appendChild($insertNode);
                        }
                    } else {
                        $nodeChilds = $node->childNodes;
                        foreach ($nodeChilds as $child) {
                            if ($child->nodeName == 'w:name') {
                                $styleName = $child->getAttribute('w:val');
                                if (in_array($styleName, $myStyles)) {
                                    $insertNode = $this->_wordStylesT->importNode($node, true);
                                    $baseNode->appendChild($insertNode);
                                }
                            }
                        }
                    }
                } else {
                    $insertNode = $this->_wordStylesT->importNode($node, true);
                    $baseNode->appendChild($insertNode);
                }
            }
        }

        PhpdocxLogger::logger('Importing styles from an external docx.', 'info');
    }

    /**
     * Insert a Word fragment before or after a node into the document content.
     *
     * @access public
     * @param WordFragment $wordFragment the WordML fragment to insert.
     * @param array $referenceNode (if empty or null force append)
     * Keys and values:
     *     'type' (string) can be * (all, default value), bookmark, break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for links and lists), section, shape, table
     *     'contains' (string) for bookmark, list, paragraph (text, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default) for document target, w:hdr for header target, w:ftr for footer target, '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     *     'target' (string) document (default), header, footer
     *     'reference' (array) for header and footer targets, allowed keys:
     *         'positions' (array) 1, 2... based on the sectPr contents order
     *         'sections' (array) 1, 2...
     *         'types' (array) 'first', 'even', 'default'
     * @param string $location after (default), before, inlineBefore or inlineAfter (don't create a new w:p and add the WordFragment before or after the referenceNode, only inline elements)
     * @param bool $forceAppend if true appends the WordFragment if the reference node could not be found (false as default)
     * @return void
     * @throws Exception method not available, adding a wrong content, not valid location
     */
    public function insertWordFragment($wordFragment, $referenceNode = array(), $location = 'after', $forceAppend = false)
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // if there's no referenceNode force append
        if ($referenceNode === null || count($referenceNode) == 0) {
            $forceAppend = true;
        }

        if ($wordFragment instanceof WordFragment) {
            PhpdocxLogger::logger('Insertion of a WordML fragment into the Word document', 'info');
            $source = 'WordFragment';
        } else {
            PhpdocxLogger::logger('You are trying to insert a non-valid object', 'fatal');
        }

        // choose the reference node based on content
        if (!isset($referenceNode['type'])) {
            $referenceNode['type'] = '*';
        }

        // manage types with more than one tag
        if ($referenceNode['type'] == 'bookmark') {
            $referenceNode['type'] = 'bookmarkStart';
            if ($location == 'after') {
                $referenceNode['type'] = 'bookmarkEnd';
            }
        }

        // target
        if (!isset($referenceNode['target'])) {
            $referenceNode['target'] = 'document';
        }

        // reference
        if (!isset($referenceNode['reference'])) {
            $referenceNode['reference'] = array();
        }

        // throw an exception if doing a not valid insertion
        try {
            if (
                ($referenceNode['type'] == 'break' || $referenceNode['type'] == 'endnote' || $referenceNode['type'] == 'footnote' || $referenceNode['type'] == 'table') &&
                ($location == 'inlineBefore' || $location == 'inlineAfter')
            ) {
                throw new Exception('You can\'t use location ' . $location . ' if type is ' . $referenceNode['type'] . '.');
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }

        if ($referenceNode['target'] == 'header' || $referenceNode['target'] == 'footer') {
            // not document targets

            $contents = $this->getWordContentByRels($referenceNode);

            if (count($contents) > 0) {
                $query = $this->getWordContentQuery($referenceNode);
                foreach ($contents as $content) {
                    $domDocument = $content['document'];
                    $domXpath = $content['documentXpath'];
                    $target = $content['target'];

                    $contentNodes = $domXpath->query($query);

                    // check if inline location
                    $inline = false;
                    if ($location == 'inlineBefore' || $location == 'inlineAfter') {
                        $inline = $location;
                    }

                    if ($contentNodes->length > 0) {
                        foreach ($contentNodes as $contentNode) {
                            if ($location == 'before' || $location == 'inlineBefore' || $location == 'inlineAfter') {
                                $referenceNode = $contentNode;
                            } else {
                                $referenceNode = $contentNode->nextSibling;
                                if (!($referenceNode instanceof DOMNode) || $referenceNode->nodeName == 'w:sectPr') {
                                    $referenceNode = $contentNode->parentNode;

                                    $inline = 'append';
                                }
                            }

                            $this->insertContentToDocumentRels($wordFragment, $domDocument, $source, $target, $referenceNode, $inline);
                        }
                    } else {
                        if ($forceAppend) {
                            PhpdocxLogger::logger('The reference node could not be found. The selection will be appended.', 'info');
                            $this->appendWordFragment($wordFragment);
                        }
                    }
                }
            }
        } else {
            // default as document

            list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);

            $query = $this->getWordContentQuery($referenceNode);

            $contentNodes = $domXpath->query($query);

            // check if inline location
            $inline = false;
            if ($location == 'inlineBefore' || $location == 'inlineAfter') {
                $inline = $location;
            }

            if ($contentNodes->length > 0) {
                foreach ($contentNodes as $contentNode) {
                    if ($location == 'before' || $location == 'inlineBefore' || $location == 'inlineAfter') {
                        $referenceNode = $contentNode;
                    } else {
                        $referenceNode = $contentNode->nextSibling;
                        if (!($referenceNode instanceof DOMNode) || $referenceNode->nodeName == 'w:sectPr') {
                            $referenceNode = $contentNode->parentNode;

                            $inline = 'append';
                        }
                    }

                    $this->insertContentToDocument($wordFragment, $domDocument, $source, $referenceNode, $inline);
                }
            } else {
                if ($forceAppend) {
                    PhpdocxLogger::logger('The reference node could not be found. The selection will be appended.', 'info');
                    $this->appendWordFragment($wordFragment);
                }
            }
        }
    }

    /**
     * Modify page layout
     *
     * @access public
     * @param array paperType (string): A4, A3, letter, legal, A4-landscape, A3-landscape, letter-landscape, legal-landscape, custom
     * @param array options
     * Values:
     * width (int): measurement in twips (twentieths of a point)
     * height (int): measurement in twips (twentieths of a point)
     * numberCols (int): integer
     * orient (string): portrait, landscape
     * marginTop (int): measurement in twips (twentieths of a point)
     * marginRight (int): measurement in twips (twentieths of a point)
     * marginBottom (int): measurement in twips (twentieths of a point)
     * marginLeft (int): measurement in twips (twentieths of a point)
     * marginHeader (int): measurement in twips (twentieths of a point)
     * marginFooter (int): measurement in twips (twentieths of a point)
     * space (int): column spacing, measurement in twips (twentieths of a point)
     * gutter (int): measurement in twips (twentieths of a point)
     * bidi (bool): set to true for right to left languages
     * rtlGutter (bool): set to true for right to left languages
     * onlyLastSection (bool): if true it only modifies the last section (default value is false)
     * sectionNumbers (array): an array with the sections that we want to modify
     * pageNumberType (array) with the following keys and values:
     *     fmt (string): number format (cardinalText, decimal, decimalEnclosedCircle, decimalEnclosedFullstop, decimalEnclosedParen, decimalZero, lowerLetter, lowerRoman, none, ordinalText, upperLetter, upperRoman)
     *     start (int): page number
     * columns (array) allows generating a page layout with custom column numbers and sizes with the following keys and values:
     *     width (int)
     *     space (int)
     * endnotes (array) sets endnote options with the following keys and values:
     *     numFmt (string) numbering format: decimal, upperRoman, lowerRoman, upperLetter...
     *     numRestart (string) continuous, eachSect, eachPage
     *     numStart (int) starting value
     *     pos (string) sectEnd, docEnd
     * footnotes (array) sets footnote options with the following keys and values:
     *     numFmt (string) numbering format: decimal, upperRoman, lowerRoman, upperLetter...
     *     numRestart (string) continuous, eachSect, eachPage
     *     numStart (int) starting value
     *     pos (string) pageBottom, beneathText
     * @throws Exception invalid paper size
     */
    public function modifyPageLayout($paperType = 'letter', $options = array())
    {
        $options = $options = self::setRTLOptions($options);
        if (empty($options['onlyLastSection'])) {
            $options['onlyLastSection'] = false;
        }
        $paperTypes = array('A4',
            'A3',
            'letter',
            'legal',
            'A4-landscape',
            'A3-landscape',
            'letter-landscape',
            'legal-landscape',
            'custom');

        $layoutOptions = array('width',
            'height',
            'numberCols',
            'orient',
            'code',
            'marginTop',
            'marginRight',
            'marginBottom',
            'marginLeft',
            'marginHeader',
            'marginFooter',
            'gutter',
            'bidi',
            'rtlGutter');
        $referenceSizes = array(
            'A4' => array(
                'width' => '11906',
                'height' => '16838',
                'numberCols' => '1',
                'orient' => 'portrait',
                'code' => '9',
                'marginTop' => '1417',
                'marginRight' => '1701',
                'marginBottom' => '1417',
                'marginLeft' => '1701',
                'marginHeader' => '708',
                'marginFooter' => '708',
                'gutter' => '0'
            ),
            'A4-landscape' => array(
                'width' => '16838',
                'height' => '11906',
                'numberCols' => '1',
                'orient' => 'landscape',
                'code' => '9',
                'marginTop' => '1701',
                'marginRight' => '1417',
                'marginBottom' => '1701',
                'marginLeft' => '1417',
                'marginHeader' => '708',
                'marginFooter' => '708',
                'gutter' => '0'
            ),
            'A3' => array(
                'width' => '16839',
                'height' => '23814',
                'numberCols' => '1',
                'orient' => 'portrait',
                'code' => '8',
                'marginTop' => '1417',
                'marginRight' => '1701',
                'marginBottom' => '1417',
                'marginLeft' => '1701',
                'marginHeader' => '708',
                'marginFooter' => '708',
                'gutter' => '0'
            ),
            'A3-landscape' => array(
                'width' => '23814',
                'height' => '16839',
                'numberCols' => '1',
                'orient' => 'landscape',
                'code' => '8',
                'marginTop' => '1701',
                'marginRight' => '1417',
                'marginBottom' => '1701',
                'marginLeft' => '1417',
                'marginHeader' => '708',
                'marginFooter' => '708',
                'gutter' => '0'
            ),
            'letter' => array(
                'width' => '12240',
                'height' => '15840',
                'numberCols' => '1',
                'orient' => 'portrait',
                'code' => '1',
                'marginTop' => '1417',
                'marginRight' => '1701',
                'marginBottom' => '1417',
                'marginLeft' => '1701',
                'marginHeader' => '708',
                'marginFooter' => '708',
                'gutter' => '0'
            ),
            'letter-landscape' => array(
                'width' => '15840',
                'height' => '12240',
                'numberCols' => '1',
                'orient' => 'landscape',
                'code' => '1',
                'marginTop' => '1701',
                'marginRight' => '1417',
                'marginBottom' => '1701',
                'marginLeft' => '1417',
                'marginHeader' => '708',
                'marginFooter' => '708',
                'gutter' => '0'
            ),
            'legal' => array(
                'width' => '12240',
                'height' => '20160',
                'numberCols' => '1',
                'orient' => 'portrait',
                'code' => '5',
                'marginTop' => '1417',
                'marginRight' => '1701',
                'marginBottom' => '1417',
                'marginLeft' => '1701',
                'marginHeader' => '708',
                'marginFooter' => '708',
                'gutter' => '0'
            ),
            'legal-landscape' => array(
                'width' => '20160',
                'height' => '12240',
                'numberCols' => '1',
                'orient' => 'landscape',
                'code' => '5',
                'marginTop' => '1701',
                'marginRight' => '1417',
                'marginBottom' => '1701',
                'marginLeft' => '1417',
                'marginHeader' => '708',
                'marginFooter' => '708',
                'gutter' => '0'
            ),
        );

        try {
            if (!in_array($paperType, $paperTypes)) {
                throw new Exception('You have used an invalid paper size');
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }


        $layout = array();
        foreach ($layoutOptions as $opt) {
            if (isset($referenceSizes[$paperType][$opt])) {
                $layout[$opt] = $referenceSizes[$paperType][$opt];
            }
        }
        foreach ($layoutOptions as $opt) {
            if (isset($options[$opt])) {
                $layout[$opt] = $options[$opt];
            }
        }

        if (isset($options['pageNumberType'])) {
            $layout['pageNumberType'] = $options['pageNumberType'];
        }

        if (!isset($options['sectionNumbers'])) {
            $options['sectionNumbers'] = null;
        }
        // get the current sectPr nodes
        if ($options['onlyLastSection']) {
            $this->_tempDocumentDOM = $this->getDOMDocx();
            $sectPrNodes = array();
            $sectPrNodes[] = $this->_sectPr->documentElement;
        } else {
            $sectPrNodes = $this->getSectionNodes($options['sectionNumbers']);
        }
        // modify them
        foreach ($sectPrNodes as $sectionNode) {
            if (isset($layout['width'])) {
                $sectionNode->getElementsByTagName('pgSz')->item(0)->setAttribute('w:w', $layout['width']);
            }
            if (isset($layout['height'])) {
                $sectionNode->getElementsByTagName('pgSz')->item(0)->setAttribute('w:h', $layout['height']);
            }
            if (isset($layout['orient'])) {
                $this->_sectPr->getElementsByTagName('pgSz')->item(0)->setAttribute('w:orient', $layout['orient']);
            }
            if (isset($layout['code'])) {
                $sectionNode->getElementsByTagName('pgSz')->item(0)->setAttribute('w:code', $layout['code']);
            }
            if (isset($layout['marginTop'])) {
                $sectionNode->getElementsByTagName('pgMar')->item(0)->setAttribute('w:top', $layout['marginTop']);
            }
            if (isset($layout['marginRight'])) {
                $sectionNode->getElementsByTagName('pgMar')->item(0)->setAttribute('w:right', $layout['marginRight']);
            }
            if (isset($layout['marginBottom'])) {
                $sectionNode->getElementsByTagName('pgMar')->item(0)->setAttribute('w:bottom', $layout['marginBottom']);
            }
            if (isset($layout['marginLeft'])) {
                $sectionNode->getElementsByTagName('pgMar')->item(0)->setAttribute('w:left', $layout['marginLeft']);
            }
            if (isset($layout['marginHeader'])) {
                $sectionNode->getElementsByTagName('pgMar')->item(0)->setAttribute('w:header', $layout['marginHeader']);
            }
            if (isset($layout['marginFooter'])) {
                $sectionNode->getElementsByTagName('pgMar')->item(0)->setAttribute('w:footer', $layout['marginFooter']);
            }
            if (isset($layout['gutter'])) {
                $sectionNode->getElementsByTagName('pgMar')->item(0)->setAttribute('w:gutter', $layout['gutter']);
            }
            if (isset($layout['bidi'])) {
                $this->modifySingleSectionProperty($sectionNode, 'bidi', array('val' => $layout['bidi']));
            }
            if (isset($layout['rtlGutter'])) {
                $this->modifySingleSectionProperty($sectionNode, 'rtlGutter', array('val' => $layout['rtlGutter']));
            }
            if (isset($layout['pageNumberType'])) {
                $this->modifySingleSectionProperty($sectionNode, 'pgNumType', array('fmt' => $layout['pageNumberType']['fmt'], 'start' => $layout['pageNumberType']['start']));
            }

            // look at the case of numberCols
            if (isset($layout['numberCols'])) {
                if ($sectionNode->getElementsByTagName('cols')->length > 0) {
                    $sectionNode->getElementsByTagName('cols')->item(0)->setAttribute('w:num', $layout['numberCols']);
                } else {
                    $colsNode = $sectionNode->ownerDocument->createDocumentFragment();
                    $colsNode->appendXML('<w:cols w:num="' . $layout['numberCols'] . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" />');
                    $sectionNode->appendChild($colsNode);
                }
            }

            if (isset($options['space'])) {
                if ($sectionNode->getElementsByTagName('cols')->length > 0) {
                    $sectionNode->getElementsByTagName('cols')->item(0)->setAttribute('w:space', $options['space']);
                } else {
                    $colsNode = $sectionNode->ownerDocument->createDocumentFragment();
                    $colsNode->appendXML('<w:cols w:num="' . $layout['numberCols'] . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" w:space="' . $options['space'] . '"/>');
                    $sectionNode->appendChild($colsNode);
                }
            }

            if (isset($options['columns']) && array($options['columns'])) {
                if ($sectionNode->getElementsByTagName('cols')->length > 0) {
                    $sectionNode->getElementsByTagName('cols')->item(0)->setAttribute('w:equalWidth', '0');
                } else {
                    $colsNode = $sectionNode->ownerDocument->createDocumentFragment();
                    $colsNode->appendXML('<w:cols w:num="' . $layout['numberCols'] . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" w:space="' . $options['columns'][0]['space'] . '"/>');
                    $sectionNode->appendChild($colsNode);
                }

                // remove existing internal columns to avoid generating more col tags than the requested
                $colsNode = $sectionNode->getElementsByTagName('cols')->item(0);
                $colNodes = $colsNode->getElementsByTagName('col');
                $nodesToBeRemoved = array();
                foreach ($colNodes as $currentColNode) {
                    $nodesToBeRemoved[] = $currentColNode;
                }
                foreach ($nodesToBeRemoved as $nodeToBeRemoved) {
                    $nodeToBeRemoved->parentNode->removeChild($nodeToBeRemoved);
                }

                foreach ($options['columns'] as $columnData) {
                    $colNode = $colsNode->ownerDocument->createDocumentFragment();
                    if (isset($columnData['space'])) {
                        $colNode->appendXML('<w:col w:w="' . $columnData['width'] . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" w:space="' . $options['space'] . '"/>');
                    } else {
                        $colNode->appendXML('<w:col w:w="' . $columnData['width'] . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" />');
                    }
                    $colsNode->appendChild($colNode);
                }
            }

            if (isset($options['footnotes']) && array($options['footnotes'])) {
                if ($sectionNode->getElementsByTagName('footnotePr')->length == 0) {
                    $footnotePrNode = $sectionNode->ownerDocument->createDocumentFragment();
                    $footnotePrNode->appendXML('<w:footnotePr xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"></w:footnotePr>');
                    $sectionNode->appendChild($footnotePrNode);
                }

                foreach ($options['footnotes'] as $footnoteSectionKey => $footnoteSectionValue) {
                    $sectionFootnotePr = $sectionNode->getElementsByTagName('footnotePr');
                    if ($sectionFootnotePr->length > 0) {
                        $sectionFootnoteProperty = $sectionFootnotePr->item(0)->getElementsByTagName($footnoteSectionKey);
                        if ($sectionFootnoteProperty->length == 0) {
                            // create the property
                            $footnotePrNode = $sectionFootnotePr->item(0)->ownerDocument->createDocumentFragment();
                            $footnotePrNode->appendXML('<w:' . $footnoteSectionKey . ' ' . 'w:val="' . $footnoteSectionValue . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" />');
                            $sectionFootnotePr->item(0)->appendChild($footnotePrNode);
                        } else {
                            // update the existing property
                            $sectionFootnoteProperty->item(0)->setAttribute('w:val', $footnoteSectionValue);
                        }
                    }
                }
            }

            if (isset($options['endnotes']) && array($options['endnotes'])) {
                if ($sectionNode->getElementsByTagName('endnotePr')->length == 0) {
                    $endnotePrNode = $sectionNode->ownerDocument->createDocumentFragment();
                    $endnotePrNode->appendXML('<w:endnotePr xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"></w:endnotePr>');
                    $sectionNode->appendChild($endnotePrNode);
                }

                foreach ($options['endnotes'] as $endnoteSectionKey => $endnoteSectionValue) {
                    $sectionEndnotePr = $sectionNode->getElementsByTagName('endnotePr');
                    if ($sectionEndnotePr->length > 0) {
                        $sectionEndnoteProperty = $sectionEndnotePr->item(0)->getElementsByTagName($endnoteSectionKey);
                        if ($sectionEndnoteProperty->length == 0) {
                            // create the property
                            $endnotePrNode = $sectionEndnotePr->item(0)->ownerDocument->createDocumentFragment();
                            $endnotePrNode->appendXML('<w:' . $endnoteSectionKey . ' ' . 'w:val="' . $endnoteSectionValue . '" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" />');
                            $sectionEndnotePr->item(0)->appendChild($endnotePrNode);
                        } else {
                            // update the existing property
                            $sectionEndnoteProperty->item(0)->setAttribute('w:val', $endnoteSectionValue);
                        }
                    }
                }
            }
        }

        $this->restoreDocumentXML();
    }

    /**
     * Move an existing Word content to other location in the same document
     *
     * @access public
     * @param array $referenceNodeFrom
     * Keys and values:
     *     'type' (string) can be * (all, default value), break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for bookmarks, links and lists), section, shape, table
     *     'contains' (string) for list, paragraph (text, bookmark, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     * @param array $referenceNodeTo
     * Keys and values:
     *     'type' (string) can be * (all, default value), break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for bookmarks, links and lists), section, shape, table
     *     'contains' (string) for list, paragraph (text, bookmark, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     * @param string $location after (default) or before
     * @param bool $forceAppend if true appends the WordFragment if the referenceNodeTo could not be found (false as default)
     * @return void
     * @throws Exception method not available
     */
    public function moveWordContent($referenceNodeFrom, $referenceNodeTo, $location = 'after', $forceAppend = false)
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        $target = 'document';
        list($domDocument, $domXpath) = $this->getWordContentDOM($target);

        // get the referenceNode
        $referencedWordContentQuery = $this->getWordContentQuery($referenceNodeFrom);
        $contentNodesReferencedWordContent = $domXpath->query($referencedWordContentQuery);

        if ($contentNodesReferencedWordContent->length <= 0) {
            PhpdocxLogger::logger('The reference node could not be found.', 'info');

            return;
        }

        $referenceWordContentXML = '';
        $cursorContents = array();
        $cursorContentIndex = 0;
        foreach ($contentNodesReferencedWordContent as $contentNodeReferencedWordContent) {
            $referenceWordContentXML .= $domDocument->saveXML($contentNodeReferencedWordContent);

            // remove referenceNodeFrom
            $contentNodeReferencedWordContent->parentNode->removeChild($contentNodeReferencedWordContent);
        }

        // get the referenceNodeTo
        $referencedWordContentToQuery = $this->getWordContentQuery($referenceNodeTo);
        $contentNodesReferencedToWordContent = $domXpath->query($referencedWordContentToQuery);

        // move the content if the reference content exists or forceAppend is set as true, otherwise don't move anything
        if ($contentNodesReferencedToWordContent->length > 0 || $forceAppend) {
            if ($contentNodesReferencedToWordContent->length <= 0 && $forceAppend) {
                PhpdocxLogger::logger('The reference node to could not be found. The selection will be appended.', 'info');

                // get last element as referenceNodeTo
                $referencedWordContentToQuery = $this->getWordContentQuery(array('type' => '*', 'occurrence' => -1));
                $contentNodesReferencedToWordContent = $domXpath->query($referencedWordContentToQuery);
            }

            $cursor = $domDocument->createElement('cursor', 'WordFragment');

            foreach ($contentNodesReferencedToWordContent as $contentNodeReferencedToWordContent) {
                if ($location == 'before') {
                    $contentNodeReferencedToWordContent->parentNode->insertBefore($cursor, $contentNodeReferencedToWordContent);
                } else {
                    $contentNodeReferencedToWordContent->parentNode->insertBefore($cursor, $contentNodeReferencedToWordContent->nextSibling);
                }
            }
        }

        $stringDoc = $domDocument->saveXML();
        $bodyTag = explode('<w:body>', $stringDoc);
        $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        $this->_wordDocumentC = str_replace('<cursor>WordFragment</cursor>', $referenceWordContentXML, $this->_wordDocumentC);
    }

    /**
     * Gets the Ids associated with the different styles in the current document or an external docx.
     * It returns a docx with all the avalaible paragraph, character, list and table styles.
     *
     * @access public
     */
    public function parseStyles()
    {
        if ($this->_docxTemplate == true) {
            $tempTitle = explode('/', $this->_baseTemplatePath);
        } else {
            $tempTitle = explode('/', PHPDOCX_BASE_TEMPLATE);
        }
        $title = array_pop($tempTitle);
        $this->_wordDocumentC = '';
        $parsedStyles = $this->_wordStylesT->saveXML();
        $parsedNumberings = $this->_wordNumberingT;

        // include certain sample content to create the resulting style docx

        $myParagraph = 'This is some sample paragraph test';
        $myList = array('item 1', 'item 2', array('subitem 2_1', 'subitem 2_2'), 'item 3', array('subitem 3_1', 'subitem 3_2', array('sub_subitem 3_2_1', 'sub_subitem 3_2_1')), 'item 4');
        $myTable = array(
            array(
                'Title A',
                'Title B',
                'Title C'
            ),
            array(
                'First row A',
                'First row B',
                'First row C'
            ),
            array(
                'Second row A',
                'Second row B',
                'Second row C'
            )
        );

        // parse the different list numberings from
        $this->addText('List styles: ' . $title, array('jc' => 'center', 'color' => 'b90000', 'b' => 'single', 'sz' => '18', 'u' => 'double'));

        $wordListChunk = '<w:p><w:pPr><w:rPr><w:b/></w:rPr></w:pPr>
        <w:r><w:rPr><w:b/></w:rPr><w:t>SAMPLE CODE:</w:t></w:r>
        </w:p><w:tbl><w:tblPr><w:tblW w:w="0" w:type="auto"/>
        <w:shd w:val="clear" w:color="auto" w:fill="DDD9C3"/>
        <w:tblLook w:val="04A0"/></w:tblPr><w:tblGrid>
        <w:gridCol w:w="8644"/></w:tblGrid><w:tr><w:tc>
        <w:tcPr><w:tcW w:w="8644" w:type="dxa"/>
        <w:shd w:val="clear" w:color="auto" w:fill="DCDAC4"/>
        </w:tcPr><w:p><w:pPr><w:spacing w:before="200"/></w:pPr>
        <w:r><w:t>$</w:t></w:r><w:r>
        <w:t>myList</w:t></w:r><w:r>
        <w:t xml:space="preserve"> = array(\'item 1\', </w:t>
        </w:r><w:r>
        <w:br/>
        <w:t xml:space="preserve">                             </w:t>
        </w:r><w:r>
        <w:t xml:space="preserve">\'item 2\', </w:t>
        </w:r><w:r><w:br/>
        <w:t xml:space="preserve">                             </w:t>
        </w:r><w:r><w:t>array(\'</w:t></w:r><w:r><w:t>subitem</w:t>
        </w:r><w:r>
        <w:t xml:space="preserve"> 2_1\', </w:t></w:r><w:r><w:br/>
        <w:t xml:space="preserve">                                        </w:t>
        </w:r><w:r><w:t>\'</w:t>
        </w:r><w:r><w:t>subitem</w:t></w:r><w:r>
        <w:t xml:space="preserve"> 2_2\'), </w:t></w:r><w:r><w:br/>
        <w:t xml:space="preserve">                             </w:t>
        </w:r><w:r><w:t xml:space="preserve">\'item 3\', </w:t></w:r>
        <w:r><w:br/>
        <w:t xml:space="preserve">                             </w:t>
        </w:r><w:r><w:t>array(\'</w:t></w:r><w:r><w:t>subitem</w:t>
        </w:r><w:r><w:t xml:space="preserve"> 3_1\', </w:t></w:r>
        <w:r><w:br/>
        <w:t xml:space="preserve">                                        </w:t>
        </w:r><w:r><w:t>\'</w:t></w:r><w:r><w:t>subitem</w:t></w:r>
        <w:r><w:t xml:space="preserve"> 3_2\', </w:t></w:r><w:r><w:br/>
        <w:t xml:space="preserve">                                        </w:t>
        </w:r><w:r><w:t>array(\'</w:t></w:r><w:r><w:t>sub_subitem</w:t></w:r><w:r>
        <w:t xml:space="preserve"> 3_2_1\', </w:t></w:r><w:r><w:br/>
        <w:t xml:space="preserve">                                                   </w:t>
        </w:r><w:r><w:t>\'</w:t></w:r><w:r><w:t>sub_subitem</w:t></w:r><w:r>
        <w:t xml:space="preserve"> 3_2_1\')),</w:t></w:r><w:r><w:br/>
        <w:t xml:space="preserve">                             </w:t>
        </w:r><w:r><w:t xml:space="preserve"> \'item 4\');</w:t></w:r></w:p>
        <w:p><w:pPr><w:spacing w:before="200"/></w:pPr>
        <w:r><w:t>addList</w:t></w:r><w:r><w:t>($</w:t></w:r>
        <w:r><w:t>myList</w:t></w:r><w:r><w:t>, NUMID</w:t></w:r>
        <w:r><w:t>))</w:t></w:r></w:p></w:tc></w:tr></w:tbl><w:p><w:pPr></w:pPr>
        </w:p>
        <w:p><w:pPr><w:rPr><w:b/></w:rPr></w:pPr>
        <w:r><w:rPr><w:b/></w:rPr><w:t>SAMPLE RESULT:</w:t></w:r>
        </w:p>';
        $NumberingsDoc = new DOMDocument();
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $NumberingsDoc->loadXML($parsedNumberings);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }
        $numberXpath = new DOMXPath($NumberingsDoc);
        $numberXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $queryNumber = '//w:num';
        $numberingsNodes = $numberXpath->query($queryNumber);
        foreach ($numberingsNodes as $node) {
            $wordListChunkTemp = str_replace('NUMID', $node->getAttribute('w:numId'), $wordListChunk);
            $this->_wordDocumentC .= $wordListChunkTemp;
            $this->addList($myList, (int) $node->getAttribute('w:numId'));
            $this->addBreak(array('type' => 'page'));
        }

        $this->addText('Paragraph, Character and Table styles: ' . $title, array('jc' => 'center', 'color' => 'b90000', 'b' => 'single', 'sz' => '18', 'u' => 'double'));

        // parse the different styles using XPath
        $StylesDoc = new DOMDocument();
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $StylesDoc->loadXML($parsedStyles);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }
        $parseStylesXpath = new DOMXPath($StylesDoc);
        $parseStylesXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $query = '//w:style';
        $parsedNodes = $parseStylesXpath->query($query);
        // list the present styles and their respective Ids
        $count = 1;
        foreach ($parsedNodes as $node) {
            $styleId = $node->getAttribute('w:styleId');
            $styleType = $node->getAttribute('w:type');
            $styleDefault = $node->getAttribute('w:default');
            $styleCustom = $node->getAttribute('w:custom');
            $nodeChilds = $node->childNodes;
            foreach ($nodeChilds as $child) {
                if ($child->nodeName == 'w:name') {
                    $styleName = $child->getAttribute('w:val');
                }
            }
            $this->_parsedStyles[$count] = array('id' => $styleId, 'name' => $styleName, 'type' => $styleType, 'default' => $styleDefault, 'custom' => $styleCustom);

            $default = ($styleDefault == 1) ? 'true' : 'false';
            $custom = ($styleCustom == 1) ? 'true' : 'false';

            $wordMLChunk = '<w:tbl><w:tblPr><w:tblW w:w="0" w:type="auto"/>
                </w:tblPr><w:tblGrid><w:gridCol w:w="4322"/><w:gridCol w:w="4322"/>
                </w:tblGrid><w:tr><w:tc><w:tcPr><w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="BD1503"/>
                </w:tcPr><w:p><w:pPr><w:spacing w:after="0"/><w:rPr>
                <w:color w:val="FFFFFF"/></w:rPr></w:pPr><w:r><w:rPr>
                <w:color w:val="FFFFFF"/></w:rPr><w:t>NAME:</w:t></w:r></w:p>
                </w:tc><w:tc><w:tcPr><w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="BD1503"/></w:tcPr>
                <w:p><w:pPr><w:spacing w:after="0"/><w:rPr><w:color w:val="FFFFFF"/>
                </w:rPr></w:pPr><w:r><w:rPr><w:color w:val="FFFFFF"/>
                </w:rPr><w:t>' . $styleName . '</w:t></w:r></w:p></w:tc>
                </w:tr><w:tr><w:tc><w:tcPr><w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="3E3E42"/>
                </w:tcPr><w:p><w:pPr><w:spacing w:after="0" w:line="240" w:lineRule="auto"/>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr></w:pPr><w:r>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr><w:t>Type</w:t>
                </w:r><w:r><w:rPr><w:color w:val="FFFFFF"/></w:rPr>
                <w:t>:</w:t></w:r></w:p></w:tc><w:tc><w:tcPr>
                <w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="3E3E42"/>
                </w:tcPr><w:p><w:pPr>
                <w:spacing w:after="0" w:line="240" w:lineRule="auto"/>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr></w:pPr><w:r>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr>
                <w:t>' . $styleType . '</w:t></w:r></w:p></w:tc></w:tr>
                <w:tr><w:tc><w:tcPr>
                <w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="3E3E42"/>
                </w:tcPr><w:p><w:pPr>
                <w:spacing w:after="0" w:line="240" w:lineRule="auto"/>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr></w:pPr><w:r>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr>
                <w:t>ID:</w:t></w:r></w:p></w:tc><w:tc>
                <w:tcPr><w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="3E3E42"/>
                </w:tcPr><w:p><w:pPr>
                <w:spacing w:after="0" w:line="240" w:lineRule="auto"/>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr></w:pPr><w:r>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr>
                <w:t>' . $styleId . '</w:t></w:r></w:p></w:tc></w:tr><w:tr><w:tc><w:tcPr>
                <w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="3E3E42"/></w:tcPr>
                <w:p><w:pPr><w:spacing w:after="0" w:line="240" w:lineRule="auto"/>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr></w:pPr><w:r>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr><w:t>Default:</w:t></w:r>
                </w:p></w:tc><w:tc><w:tcPr><w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="3E3E42"/>
                </w:tcPr><w:p><w:pPr>
                <w:spacing w:after="0" w:line="240" w:lineRule="auto"/>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr></w:pPr>
                <w:r><w:rPr><w:color w:val="FFFFFF"/></w:rPr>
                <w:t>' . $default . '</w:t></w:r></w:p></w:tc></w:tr><w:tr>
                <w:tc><w:tcPr><w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="3E3E42"/>
                </w:tcPr><w:p><w:pPr>
                <w:spacing w:after="0" w:line="240" w:lineRule="auto"/>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr></w:pPr>
                <w:r><w:rPr><w:color w:val="FFFFFF"/></w:rPr><w:t>Custom</w:t>
                </w:r><w:r><w:rPr><w:color w:val="FFFFFF"/></w:rPr>
                <w:t>:</w:t></w:r></w:p></w:tc><w:tc><w:tcPr>
                <w:tcW w:w="4322" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="3E3E42"/>
                </w:tcPr><w:p><w:pPr>
                <w:spacing w:after="0" w:line="240" w:lineRule="auto"/>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr></w:pPr><w:r>
                <w:rPr><w:color w:val="FFFFFF"/></w:rPr><w:t>' . $custom . '</w:t>
                </w:r></w:p></w:tc></w:tr></w:tbl>
                <w:p w:rsidR="000F6147" w:rsidRDefault="000F6147" w:rsidP="00B42E7D">
                <w:pPr><w:spacing w:after="0"/></w:pPr></w:p>
                <w:p w:rsidR="00DC3ACE" w:rsidRDefault="00DC3ACE">
                <w:pPr><w:rPr><w:b/></w:rPr></w:pPr><w:r>
                <w:rPr><w:b/></w:rPr><w:t>SAMPLE CODE:</w:t></w:r></w:p>
                <w:tbl><w:tblPr><w:tblW w:w="0" w:type="auto"/>
                <w:shd w:val="clear" w:color="auto" w:fill="DDD9C3"/>
                </w:tblPr><w:tblGrid><w:gridCol w:w="8644"/>
                </w:tblGrid><w:tr><w:tc><w:tcPr><w:tcW w:w="8644" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="DCDAC4"/></w:tcPr>
                <w:p w:rsidR="00DC3ACE" w:rsidRDefault="00DC3ACE">
                <w:pPr><w:spacing w:before="200" /></w:pPr><w:r>
                <w:t>CODEX</w:t></w:r></w:p></w:tc></w:tr></w:tbl><w:p/><w:p>
                <w:pPr><w:rPr><w:b/></w:rPr></w:pPr><w:r><w:rPr><w:b/>
                </w:rPr><w:t>SAMPLE RESULT:</w:t></w:r></w:p>
                ';

            switch ($styleType) {
                case 'table':
                    $wordMLChunk = str_replace('CODEX', "addTable(array(array('Title A','Title B','Title C'),array('First row A','First row B','First row C'),array('Second row A','Second row B','Second row C')), array('tableStyle'=> '$styleId'), 'columnWidths' => array(1800, 1800, 1800))", $wordMLChunk);
                    $this->_wordDocumentC .= $wordMLChunk;
                    $params = array('tableStyle' => $styleId, 'columnWidths' => array(1800, 1800, 1800));
                    $this->addTable($myTable, $params);
                    if ($count % 2 == 0) {
                        $this->_wordDocumentC .= '<w:p><w:r><w:br w:type="page"/></w:r></w:p>';
                    } else {
                        $this->_wordDocumentC .= '<w:p /><w:p />';
                    }
                    $count++;
                    break;
                case 'paragraph':
                    $myPCode = "addText('This is some sample paragraph test', array('pStyle' => '" . $styleId . "'))";
                    $wordMLChunk = str_replace('CODEX', $myPCode, $wordMLChunk);
                    $this->_wordDocumentC .= $wordMLChunk;
                    $params = array('pStyle' => $styleId);
                    $this->addText($myParagraph, $params);
                    if ($count % 2 == 0) {
                        $this->_wordDocumentC .= '<w:p><w:r><w:br w:type="page"/></w:r></w:p>';
                    } else {
                        $this->_wordDocumentC .= '<w:p /><w:p />';
                    }
                    $count++;
                    break;
                case 'character':
                    $myPCode = "addText('This is some sample character test', array('rStyle' => '" . $styleId . "'))";
                    $wordMLChunk = str_replace('CODEX', $myPCode, $wordMLChunk);
                    $this->_wordDocumentC .= $wordMLChunk;
                    $params = array('rStyle' => $styleId);
                    $this->addText($myParagraph, $params);
                    $this->_wordDocumentC .= '<w:p /><w:p />';
                    $count++;
                    break;
            }
        }
    }

    /**
     * Reject a tracked content or tracked style
     *
     * @access public
     * @param array $referenceNode
     * Keys and values:
     *     'type' (string) can be * (all, default value), break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for bookmarks, links and lists), section, shape, table
     *     'contains' (string) for list, paragraph (text, bookmark, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     * @return void
     * @throws Exception method not available
     */
    public function rejectTracking($referenceNode)
    {
        if (!file_exists(dirname(__FILE__) . '/Tracking.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // choose the reference node based on content
        if (!isset($referenceNode['type'])) {
            $referenceNode['type'] = '*';
        }

        // document
        $referenceNode['target'] = 'document';
        list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);
        $query = $this->getWordContentQuery($referenceNode);
        $tracking = new Tracking();
        $newDomDocument = $tracking->rejectTracking($domDocument, $domXpath, $query);
        if ($newDomDocument) {
            $this->regenerateXMLContent($referenceNode['target'], $newDomDocument);
        }

        // lastSection
        $referenceNode['target'] = 'lastSection';
        list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);
        $query = $this->getWordContentQuery($referenceNode);
        $tracking = new Tracking();
        $newDomDocument = $tracking->rejectTracking($domDocument, $domXpath, $query);
        if ($newDomDocument) {
            $this->regenerateXMLContent($referenceNode['target'], $newDomDocument);
        }
    }

    /**
     *
     * Remove existing footers
     *
     */
    public function removeFooters()
    {
        foreach ($this->_relsFooter as $key => $value) {
            // first remove the actual footer files
            $this->_zipDocx->deleteContent('word/' . $value);
            $this->_zipDocx->deleteContent('word/_rels/' . $value . '.rels');

            // modify the rels file
            $relationships = $this->_wordRelsDocumentRelsT->getElementsByTagName('Relationship');
            $counter = $relationships->length - 1;
            for ($j = $counter; $j > -1; $j--) {
                $target = $relationships->item($j)->getAttribute('Target');
                if ($target == $value) {
                    $this->_wordRelsDocumentRelsT->documentElement->removeChild($relationships->item($j));
                }
            }
            // remove the corresponding override tags from [Content_Types].xml
            $overrides = $this->_contentTypeT->getElementsByTagName('Override');
            $counter = $overrides->length - 1;
            for ($j = $counter; $j > -1; $j--) {
                $target = $overrides->item($j)->getAttribute('PartName');
                if ($target == '/word/' . $value) {
                    $this->_contentTypeT->documentElement->removeChild($overrides->item($j));
                }
            }
        }
        // change the section properties
        $footers = $this->_sectPr->getElementsByTagName('footerReference');
        $counter = $footers->length - 1;
        for ($j = $counter; $j > -1; $j--) {
            $this->_sectPr->documentElement->removeChild($footers->item($j));
        }
        $titlePage = $this->_sectPr->getElementsByTagName('titlePg');
        $counter = $titlePage->length - 1;
        for ($j = $counter; $j > -1; $j--) {
            $this->_sectPr->documentElement->removeChild($titlePage->item($j));
        }
        // remove the footer references that may exist
        // within $this->_wordDocumentC
        $domDocument = $this->getDOMDocx();
        $footers = $domDocument->getElementsByTagName('footerReference');
        $counter = $footers->length - 1;
        for ($j = $counter; $j > -1; $j--) {
            $footers->item($j)->parentNode->removeChild($footers->item($j));
        }
        $titlePage = $domDocument->getElementsByTagName('titlePg');
        $counter = $titlePage->length - 1;
        for ($j = $counter; $j > -1; $j--) {
            $titlePage->item($j)->parentNode->removeChild($titlePage->item($j));
        }
        $this->_tempDocumentDOM = $domDocument;
        $this->restoreDocumentXML();
        // finally, if it exists, the evenAndOddHeader element from settings
        $this->removeSetting('w:evenAndOddHeaders');
    }

    /**
     *
     * Remove existing headers
     *
     */
    public function removeHeaders()
    {

        foreach ($this->_relsHeader as $key => $value) {
            // first remove the actual header files
            $this->_zipDocx->deleteContent('word/' . $value);
            $this->_zipDocx->deleteContent('word/_rels/' . $value . '.rels');

            // modify the rels file
            $relationships = $this->_wordRelsDocumentRelsT->getElementsByTagName('Relationship');
            $counter = $relationships->length - 1;
            for ($j = $counter; $j > -1; $j--) {
                $target = $relationships->item($j)->getAttribute('Target');
                if ($target == $value) {
                    $this->_wordRelsDocumentRelsT->documentElement->removeChild($relationships->item($j));
                }
            }

            // remove the corresponding override tags from [Content_Types].xml
            $overrides = $this->_contentTypeT->getElementsByTagName('Override');
            $counter = $overrides->length - 1;
            for ($j = $counter; $j > -1; $j--) {
                $target = $overrides->item($j)->getAttribute('PartName');
                if ($target == '/word/' . $value) {
                    $this->_contentTypeT->documentElement->removeChild($overrides->item($j));
                }
            }
        }

        // change the section properties
        $headers = $this->_sectPr->getElementsByTagName('headerReference');
        $counter = $headers->length - 1;
        for ($j = $counter; $j > -1; $j--) {
            $this->_sectPr->documentElement->removeChild($headers->item($j));
        }
        $titlePage = $this->_sectPr->getElementsByTagName('titlePg');
        $counter = $titlePage->length - 1;
        for ($j = $counter; $j > -1; $j--) {
            $this->_sectPr->documentElement->removeChild($titlePage->item($j));
        }
        // remove the header references that may exist
        // within $this->_wordDocumentC
        $domDocument = $this->getDOMDocx();
        $headers = $domDocument->getElementsByTagName('headerReference');
        $counter = $headers->length - 1;
        for ($j = $counter; $j > -1; $j--) {
            $headers->item($j)->parentNode->removeChild($headers->item($j));
        }
        $titlePage = $domDocument->getElementsByTagName('titlePg');
        $counter = $titlePage->length - 1;
        for ($j = $counter; $j > -1; $j--) {
            $titlePage->item($j)->parentNode->removeChild($titlePage->item($j));
        }
        $this->_tempDocumentDOM = $domDocument;
        $this->restoreDocumentXML();

        // finally, if it exists, the evenAndOddHeader element from settings
        $this->removeSetting('w:evenAndOddHeaders');
    }

    /**
     * Removes headers and footers
     *
     */
    public function removeHeadersAndFooters()
    {
        $this->removeHeaders();
        $this->removeFooters();
    }

    /**
     * Remove a Word content
     *
     * @access public
     * @param array $referenceNode
     * Keys and values:
     *     'type' (string) can be * (all, default value), break, chart, endnote (content reference, the whole paragraph is removed), footnote (content reference, the whole paragraph is removed), image, list, paragraph (also for bookmarks, links and lists), section, shape, table
     *     'contains' (string) for list, paragraph (text, bookmark, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     *     'target' (string) document (default), header, footer
     *     'reference' (array) for header and footer targets, allowed keys:
     *         'positions' (array) 1, 2... based on the sectPr contents order
     *         'sections' (array) 1, 2...
     *         'types' (array) 'first', 'even', 'default'
     * @return void
     * @throws Exception method not available
     */
    public function removeWordContent($referenceNode)
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // choose the reference node based on content
        if (!isset($referenceNode['type'])) {
            $referenceNode['type'] = '*';
        }

        // target
        if (!isset($referenceNode['target'])) {
            $referenceNode['target'] = 'document';
        }

        // reference
        if (!isset($referenceNode['reference'])) {
            $referenceNode['reference'] = array();
        }

        if ($referenceNode['target'] == 'header' || $referenceNode['target'] == 'footer') {
            // not document targets

            $contents = $this->getWordContentByRels($referenceNode);

            if (count($contents) > 0) {
                $query = $this->getWordContentQuery($referenceNode);
                foreach ($contents as $content) {
                    $domDocument = $content['document'];
                    $domXpath = $content['documentXpath'];
                    $target = $content['target'];

                    $contentNodes = $domXpath->query($query);

                    if ($contentNodes->length > 0) {
                        $rXPath = new DOMXPath($domDocument);
                        $rXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        foreach ($contentNodes as $contentNode) {
                            // remove referenceNodeFrom
                            if (self::$trackingEnabled == true) {
                                // get w:r contents to add the w:del tags
                                $queryR = './/w:r';
                                $rNodes = $rXPath->query($queryR, $contentNode);

                                if ($rNodes->length > 0) {
                                    foreach ($rNodes as $rNode) {
                                        // clone the node and wrap its contents in a new w:del node
                                        $delNode = $domDocument->createElement('w:del');
                                        $delNode->setAttribute('w:author', self::$trackingOptions['author']);
                                        $delNode->setAttribute('w:date', self::$trackingOptions['date']);
                                        $delNode->setAttribute('w:id', self::$trackingOptions['id']);
                                        $rNodeClone = $rNode->cloneNode(true);
                                        $delNode->appendChild($rNodeClone);
                                        $rNode->parentNode->insertBefore($delNode, $rNode);

                                        // remove the previous node
                                        $rNode->parentNode->removeChild($rNode);

                                        self::$trackingOptions['id'] = self::$trackingOptions['id'] + 1;
                                    }
                                }

                                // replace w:t tags by w:delText tags
                                $queryT = './/w:r/w:t';
                                $tNodes = $rXPath->query($queryT, $contentNode);

                                if ($tNodes->length > 0) {
                                    foreach ($tNodes as $tNode) {
                                        $delTextNode = $domDocument->createElement('w:delText', $tNode->nodeValue);
                                        $tNode->parentNode->insertBefore($delTextNode, $tNode);

                                        // remove the previous node
                                        $tNode->parentNode->removeChild($tNode);
                                    }
                                }

                                // add w:del tags in w:trPr tags
                                $queryTR = './/w:tr';
                                $trNodes = $rXPath->query($queryTR, $contentNode);

                                if ($trNodes->length > 0) {
                                    foreach ($trNodes as $trNode) {
                                        $trprNodes = $trNode->getElementsByTagNameNS("http://schemas.openxmlformats.org/wordprocessingml/2006/main", "trPr");
                                        if ($trprNodes->length > 0) {
                                            $trprNode = $trprNodes->item(0);
                                        } else {
                                            // create an insert a w:trPr tag
                                            $trprNode = $domDocument->createElement('w:trPr');
                                            $trNode->item(0)->insertBefore($trprNode, $trNode->item(0));
                                        }

                                        $delNode = $domDocument->createElement('w:del');
                                        $delNode->setAttribute('w:author', self::$trackingOptions['author']);
                                        $delNode->setAttribute('w:date', self::$trackingOptions['date']);
                                        $delNode->setAttribute('w:id', self::$trackingOptions['id']);

                                        $trprNode->appendChild($delNode);
                                    }
                                }

                                // add w:del tags in w:pPr/w:rPr tags
                                $queryPPR = './/w:pPr';
                                $pprNodes = $rXPath->query($queryPPR, $contentNode);

                                if ($pprNodes->length > 0) {
                                    foreach ($pprNodes as $pprNode) {
                                        $pprrprNodes = $pprNode->getElementsByTagNameNS("http://schemas.openxmlformats.org/wordprocessingml/2006/main", "rPr");
                                        if ($pprrprNodes->length > 0) {
                                            $pprrprNode = $pprrprNodes->item(0);
                                        } else {
                                            // create an insert a w:trPr tag
                                            $pprrprNode = $domDocument->createElement('w:rPr');
                                            $pprNode->item(0)->insertBefore($pprrprNode, $pprNode->item(0));
                                        }

                                        $delNode = $domDocument->createElement('w:del');
                                        $delNode->setAttribute('w:author', self::$trackingOptions['author']);
                                        $delNode->setAttribute('w:date', self::$trackingOptions['date']);
                                        $delNode->setAttribute('w:id', self::$trackingOptions['id']);

                                        $pprrprNode->appendChild($delNode);
                                    }
                                }
                            } else {
                                $contentNode->parentNode->removeChild($contentNode);
                            }
                        }

                        $this->saveToZip($contentNode->ownerDocument->saveXML(), $target);
                    }
                }
            }
        } else {
            // default as document

            list($domDocument, $domXpath) = $this->getWordContentDOM($referenceNode['target']);
            $query = $this->getWordContentQuery($referenceNode);

            $contentNodes = $domXpath->query($query);

            if ($contentNodes->length > 0) {
                $rXPath = new DOMXPath($domDocument);
                $rXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                foreach ($contentNodes as $contentNode) {
                    // remove referenceNodeFrom
                    if (self::$trackingEnabled == true) {
                        // get w:r contents to add the w:del tags
                        $queryR = './/w:r';
                        $rNodes = $rXPath->query($queryR, $contentNode);

                        if ($rNodes->length > 0) {
                            foreach ($rNodes as $rNode) {
                                // clone the node and wrap its contents in a new w:del node
                                $delNode = $domDocument->createElement('w:del');
                                $delNode->setAttribute('w:author', self::$trackingOptions['author']);
                                $delNode->setAttribute('w:date', self::$trackingOptions['date']);
                                $delNode->setAttribute('w:id', self::$trackingOptions['id']);
                                $rNodeClone = $rNode->cloneNode(true);
                                $delNode->appendChild($rNodeClone);
                                $rNode->parentNode->insertBefore($delNode, $rNode);

                                // remove the previous node
                                $rNode->parentNode->removeChild($rNode);

                                self::$trackingOptions['id'] = self::$trackingOptions['id'] + 1;
                            }
                        }

                        // replace w:t tags by w:delText tags
                        $queryT = './/w:r/w:t';
                        $tNodes = $rXPath->query($queryT, $contentNode);

                        if ($tNodes->length > 0) {
                            foreach ($tNodes as $tNode) {
                                $delTextNode = $domDocument->createElement('w:delText', $tNode->nodeValue);
                                $tNode->parentNode->insertBefore($delTextNode, $tNode);

                                // remove the previous node
                                $tNode->parentNode->removeChild($tNode);
                            }
                        }

                        // add w:del tags in w:trPr tags
                        $queryTR = './/w:tr';
                        $trNodes = $rXPath->query($queryTR, $contentNode);

                        if ($trNodes->length > 0) {
                            foreach ($trNodes as $trNode) {
                                $trprNodes = $trNode->getElementsByTagNameNS("http://schemas.openxmlformats.org/wordprocessingml/2006/main", "trPr");
                                if ($trprNodes->length > 0) {
                                    $trprNode = $trprNodes->item(0);
                                } else {
                                    // create an insert a w:trPr tag
                                    $trprNode = $domDocument->createElement('w:trPr');
                                    $trNode->item(0)->insertBefore($trprNode, $trNode->item(0));
                                }

                                $delNode = $domDocument->createElement('w:del');
                                $delNode->setAttribute('w:author', self::$trackingOptions['author']);
                                $delNode->setAttribute('w:date', self::$trackingOptions['date']);
                                $delNode->setAttribute('w:id', self::$trackingOptions['id']);

                                $trprNode->appendChild($delNode);
                            }
                        }

                        // add w:del tags in w:pPr/w:rPr tags
                        $queryPPR = './/w:pPr';
                        $pprNodes = $rXPath->query($queryPPR, $contentNode);

                        if ($pprNodes->length > 0) {
                            foreach ($pprNodes as $pprNode) {
                                $pprrprNodes = $pprNode->getElementsByTagNameNS("http://schemas.openxmlformats.org/wordprocessingml/2006/main", "rPr");
                                if ($pprrprNodes->length > 0) {
                                    $pprrprNode = $pprrprNodes->item(0);
                                } else {
                                    // create an insert a w:trPr tag
                                    $pprrprNode = $domDocument->createElement('w:rPr');
                                    $pprNode->item(0)->insertBefore($pprrprNode, $pprNode->item(0));
                                }

                                $delNode = $domDocument->createElement('w:del');
                                $delNode->setAttribute('w:author', self::$trackingOptions['author']);
                                $delNode->setAttribute('w:date', self::$trackingOptions['date']);
                                $delNode->setAttribute('w:id', self::$trackingOptions['id']);

                                $pprrprNode->appendChild($delNode);
                            }
                        }
                    } else {
                        $contentNode->parentNode->removeChild($contentNode);
                    }
                }

                $stringDoc = $domDocument->saveXML();
                $bodyTag = explode('<w:body>', $stringDoc);
                $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
                $this->_wordDocumentC = str_replace('<cursor>WordFragment</cursor>', '', $this->_wordDocumentC);
            }
        }
    }

    /**
     * Replace a Word content by a Word fragment
     *
     * @access public
     * @param WordFragment $wordFragment the WordML fragment to insert.
     * @param array $referenceNode
     * Keys and values:
     *     'type' (string) can be * (all, default value), break, chart, endnote (content reference), footnote (content reference), image, paragraph (also for bookmarks, links and lists), section, shape, table
     *     'contains' (string) for list, paragraph (text, bookmark, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     *     'target' (string) document (default), header, footer
     *     'reference' (array) for header and footer targets, allowed keys:
     *         'positions' (array) 1, 2... based on the sectPr contents order
     *         'sections' (array) 1, 2...
     *         'types' (array) 'first', 'even', 'default'
     * @param string $location after (default), before, inlineBefore or inlineAfter (don't create a new w:p and add the WordFragment before or after the referenceNode, only inline elements)
     * @param bool $forceAppend if true appends the WordFragment if the reference node could not be found (false as default)
     * @return void
     * @throws Exception method not available
     */
    public function replaceWordContent($wordFragment, $referenceNode, $location = 'after', $forceAppend = false)
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // insert the new content after referenceNode
        $this->insertWordFragment($wordFragment, $referenceNode, $location, $forceAppend);

        // remove referenceNode
        $this->removeWordContent($referenceNode);
    }

    /**
     * Changes the background color of the document
     *
     * @access public
     * @param string $color
     * Values: hexadecimal color value without # (ffff00, 0000ff, ...)
     */
    public function setBackgroundColor($color)
    {
        $this->_backgroundColor = $color;
        // construct the background WordML code
        if ($this->_background == '') {
            $this->_background = '<w:background w:color="' . $color . '" />';
            // modify the settings.xml file
            $this->docxSettings(array('displayBackgroundShape' => true));
        } else {
            $this->_background = str_replace('w:color="FFFFFF"', 'w:color="' . $color . '"', $this->_background);
        }
    }

    /**
     * Change the decimal symbol
     *
     * @access public
     * @param string $symbol
     *  Values: '.', ',',...
     */
    public function setDecimalSymbol($symbol)
    {
        $decimalNodes = $this->_wordSettingsT->getElementsByTagName('decimalSymbol');
        if ($decimalNodes->length > 0) {
            $decimalNode = $decimalNodes->item(0);
            $decimalNode->setAttribute('w:val', $symbol);
        }
        PhpdocxLogger::logger('Change decimal symbol.', 'info');
    }

    /**
     * Change the default font
     *
     * @access public
     * @param string $font The new font
     *  Values: 'Arial', 'Times New Roman'...
     */
    public function setDefaultFont($font)
    {
        $this->_defaultFont = $font;
        // get the original theme as a DOMdocument
        $themeDocument = $this->getFromZip('word/theme/theme1.xml', 'DOMDocument');
        $latinNode = $themeDocument->getElementsByTagName('latin');
        $latinNode->item(0)->setAttribute('typeface', $font);
        $latinNode->item(1)->setAttribute('typeface', $font);
        $this->saveToZip($themeDocument, 'word/theme/theme1.xml');
        //To preserve the default font for PDF conversion make sure the $font is
        //defined in the fontTable.xml file
        $fontDocument = $this->getFromZip('word/fontTable.xml', 'DOMDocument');
        $fontXPath = new DOMXPath($fontDocument);
        $fontXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $query = '//w:font[@w:name="' . $font . '"]';
        $fonts = $fontXPath->query($query);
        //If the font is not found append a w:font node to fontTable.xml
        if ($fonts->length == 0) {
            $newNode = $fontDocument->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:font');
            $newNode->setAttributeNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:name', $font);
            $fontDocument->documentElement->appendChild($newNode);
            $this->saveToZip($fontDocument, 'word/fontTable.xml');
        }
        PhpdocxLogger::logger('The default font was changed to ' . $font, 'info');
    }

    /**
     * Change document default styles
     *
     * @access public
     * @param mixed $styleOptions it includes the required style options
     * Array values:
     * 'backgroundColor' (string) hexadecimal value (FFFF00, CCCCCC, ...)
     * 'bidi' (bool) if true sets right to left paragraph orientation
     * 'bold' (bool)
     * 'border' (none, single, double, dashed, threeDEngrave, threeDEmboss, outset, inset, ...)
     *      this value can be override for each side with 'borderTop', 'borderRight', 'borderBottom' and 'borderLeft'
     * 'borderColor' (ffffff, ff0000)
     *      this value can be override for each side with 'borderTopColor', 'borderRightColor', 'borderBottomColor' and 'borderLeftColor'
     * 'borderSpacing' (0, 1, 2...)
     *      this value can be override for each side with 'borderTopSpacing', 'borderRightSpacing', 'borderBottomSpacing' and 'borderLeftSpacing'
     * 'borderWidth' (10, 11...) in eights of a point
     *      this value can be override for each side with 'borderTopWidth', 'borderRightWidth', 'borderBottomWidth' and 'borderLeftWidth'
     * 'caps' (bool) display text in capital letters
     * 'color' (ffffff, ff0000...)
     * 'contextualSpacing' (bool) ignore spacing above and below when using identical styles
     * 'doubleStrikeThrough' (bool)
     * 'em' (none, dot, circle, comma, underDot) emphasis mark type
     * 'firstLineIndent' first line indent in twentieths of a point (twips)
     * 'font' (Arial, Times New Roman...)
     * 'fontSize' (8, 9, 10, ...) size in points
     * 'hanging' 100, ...
     * 'indentLeft' 100, ...
     * 'indentRight' 100, ...
     * 'indentFirstLine' 100, ...
     * 'italic' (bool)
     * 'keepLines' (bool) keep all paragraph lines on the same page
     * 'keepNext' (bool) keep in the same page the current paragraph with next paragraph
     * 'lineSpacing' 120, 240 (standard), 360, 480, ...
     * 'outlineLvl' (int) heading level (1-9)
     * 'pageBreakBefore' (bool)
     * 'pStyle' id of the style this paragraph style is based on (it may be retrieved with the parseStyles method)
     * 'rtl' (bool) if true sets right to left text orientation
     * 'smallCaps' (bool) display text in small caps
     * 'spacingBottom' (int) bottom margin in twentieths of a point
     * 'spacingTop' (int) top margin in twentieths of a point
     * 'tabPositions' (array) each entry is an associative array with the following keys and values
     *      'type' (string) can be clear, left (default), center, right, decimal, bar and num
     *      'leader' (string) can be none (default), dot, hyphen, underscore, heavy and middleDot
     *      'position' (int) given in twentieths of a point
     * 'textAlign' (both, center, distribute, left, right)
     * 'textDirection' (lrTb, tbRl, btLr, lrTbV, tbRlV, tbLrV) text flow direction
     * 'underline' (none, dash, dotted, double, single, wave, words)
     * 'vanish' (bool)
     * 'widowControl' (bool)
     * 'wordWrap' (bool)
     */
    public function setDocumentDefaultStyles($styleOptions)
    {
        $styleOptions = self::translateTextOptions2StandardFormat($styleOptions);

        // get pPr and rPr styles through the paraph styles class
        $newStyle = new CreateParagraphStyle();
        $style = $newStyle->addParagraphStyle('defaultstyles', $styleOptions);

        // get the pPr childNodes if exist
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $wordStylesPPr = new DOMDocument();
        $wordStylesPPr->loadXML($style[0]);
        $pPrStyleTags = $wordStylesPPr->getElementsByTagName('pPr');
        if ($pPrStyleTags->item(0) && $pPrStyleTags->item(0)->childNodes->length > 0) {
            $pPrDefaultStyles = $this->_wordStylesT->getElementsByTagName('pPrDefault');
            $pPrDefaultStylesPprChildren = $pPrDefaultStyles->item(0)->getElementsByTagName('pPr')->item(0);

            // iterate styles to be added to replace the existing styles and add the new ones
            foreach ($wordStylesPPr->firstChild->getElementsByTagName('pPr')->item(0)->childNodes as $wordStylesPPrChildNode) {
                $tagCurrentStyle = $pPrDefaultStylesPprChildren->getElementsByTagName($wordStylesPPrChildNode->localName);

                $nodeToBeImported = $pPrDefaultStylesPprChildren->ownerDocument->importNode($wordStylesPPrChildNode);

                if ($tagCurrentStyle->length > 0) {
                    // the style exists, replace it
                    $tagCurrentStyle->item(0)->parentNode->replaceChild($nodeToBeImported, $tagCurrentStyle->item(0));
                } else {
                    // the style is new, add it
                    $nodeToBeImported = $pPrDefaultStylesPprChildren->ownerDocument->importNode($wordStylesPPrChildNode);
                    $pPrDefaultStylesPprChildren->appendChild($nodeToBeImported);
                }
            }
        }
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }

        // get the rPr childNodes if exist
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $wordStylesRPr = new DOMDocument();
        $wordStylesRPr->loadXML($style[1]);
        $rPrStyleTags = $wordStylesRPr->getElementsByTagName('rPr');
        if ($rPrStyleTags->item(0) && $rPrStyleTags->item(0)->childNodes->length > 0) {
            $rPrDefaultStyles = $this->_wordStylesT->getElementsByTagName('rPrDefault');
            $rPrDefaultStylesRprChildren = $rPrDefaultStyles->item(0)->getElementsByTagName('rPr')->item(0);

            // iterate styles to be added to replace the existing styles and add the new ones
            foreach ($wordStylesRPr->firstChild->getElementsByTagName('rPr')->item(0)->childNodes as $wordStylesRPrChildNode) {
                $tagCurrentStyle = $rPrDefaultStylesRprChildren->getElementsByTagName($wordStylesRPrChildNode->localName);

                $nodeToBeImported = $rPrDefaultStylesRprChildren->ownerDocument->importNode($wordStylesRPrChildNode);

                if ($tagCurrentStyle->length > 0) {
                    // the style exists, replace it
                    $tagCurrentStyle->item(0)->parentNode->replaceChild($nodeToBeImported, $tagCurrentStyle->item(0));
                } else {
                    // the style is new, add it
                    $nodeToBeImported = $rPrDefaultStylesRprChildren->ownerDocument->importNode($wordStylesRPrChildNode);
                    $rPrDefaultStylesRprChildren->appendChild($nodeToBeImported);
                }
            }
        }
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }
    }

    /**
     * Transform to UTF-8 charset
     *
     * @access public
     */
    public function setEncodeUTF8()
    {
        self::$_encodeUTF = 1;
    }

    /**
     * Change default language.
     * @param $lang Locale: en-US, es-ES...
     * @access public
     */
    public function setLanguage($lang = null)
    {
        if (!$lang) {
            $lang = 'en-US';
        }
        // get the original styles as a DOMdocument
        $langNode = $this->_wordStylesT->getElementsByTagName('lang');
        if ($langNode->length > 0) {
            $langNode->item(0)->setAttribute('w:val', $lang);
            $langNode->item(0)->setAttribute('w:eastAsia', $lang);
        }
        // check also if tehre is a themeFontlanfg entry in the settings file
        $themeFontLangNode = $this->_wordSettingsT->getElementsByTagName('themeFontLang');
        if ($themeFontLangNode->length > 0) {
            $themeFontLangNode->item(0)->setAttribute('w:val', $lang);
        }

        PhpdocxLogger::logger('Set language: ' . $lang, 'info');
    }

    /**
     * Mark the document as final
     *
     * @access public
     *
     */
    public function setMarkAsFinal()
    {
        $this->_markAsFinal = 1;
        $this->addProperties(array('contentStatus' => 'Final'));
        $this->generateOVERRIDE(
                '/docProps/custom.xml', 'application/vnd.openxmlformats-officedocument.' .
                'custom-properties+xml'
        );
    }

    /**
     * sets global right to left options
     * @access public
     * @param array $options
     * values:
     *  'bidi' (bool)
     *  'rtl' (bool)
     * @return void
     */
    public function setRTL($options = array('bidi' => true, 'rtl' => true))
    {
        if (isset($options['bidi']) && $options['bidi']) {
            self::$bidi = true;
        }
        if (isset($options['rtl']) && $options['rtl']) {
            self::$rtl = true;
        }
        $this->modifyPageLayout('custom', array('bidi' => $options['bidi'], 'rtlGutter' => $options['rtl']));
        // set footnotes and endnotes separators for bidi and rtl
        $notesArray = array('footnote' => $this->_wordFootnotesT, 'endnote' => $this->_wordEndnotesT);
        foreach ($notesArray as $note => $value) {
            $noteXPath = new DOMXPath($value);
            $noteXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
            $query = '//w:' . $note . '[@w:type="separator"] | //w:' . $note . '[@w:type="continuationSeparator"]';
            $selectedNodes = $noteXPath->query($query);
            foreach ($selectedNodes as $node) {
                $pPrNode = $node->getElementsbyTagName('pPr')->item(0);
                $bidiNodes = $node->getElementsbyTagName('bidi');
                if ($bidiNodes->length > 0) {
                    $bidiNodes->item(0)->setAttribute('w:val', $options['bidi']);
                } else {
                    $bidi = $pPrNode->ownerDocument->createElement('w:bidi');
                    $bidi->setAttribute('w:val', $options['bidi']);
                    $pPrNode->appendChild($bidi);
                }
                $rtlNodes = $node->getElementsbyTagName('rtl');
                if ($rtlNodes->length > 0) {
                    $rtlNodes->item(0)->setAttribute('w:val', $options['rtl']);
                } else {
                    $rtl = $pPrNode->ownerDocument->createElement('w:rtl');
                    $rtl->setAttribute('w:val', $options['rtl']);
                    $pPrNode->appendChild($rtl);
                }
            }
        }
    }

    /**
     * sets global right to left options for the different methods
     * @access public
     * @static
     * @param array $options
     * @return array
     */
    public static function setRTLOptions($options)
    {
        if (!isset($options['bidi']) && CreateDocx::$bidi) {
            $options['bidi'] = true;
        }
        if (!isset($options['rtl']) && CreateDocx::$rtl) {
            $options['rtl'] = true;
        }
        return $options;
    }

    /**
     * Transform documents
     *
     * native method supports:
     *     DOCX to HTML, PDF
     *
     * libreoffice method supports:
     *     DOCX to PDF, HTML, DOC, ODT, PNG, RTF, TXT
     *     DOC to DOCX, PDF, HTML, ODT, PNG, RTF, TXT
     *     ODT to DOCX, PDF, HTML, DOC, PNG, RTF, TXT
     *     RTF to DOCX, PDF, HTML, DOC, ODT, PNG, TXT
     *
     * openoffice method supports:
     *     DOCX to PDF, HTML, DOC, ODT, PNG, RTF, TXT
     *     DOC to DOCX, PDF, HTML, ODT, PNG, RTF, TXT
     *     ODT to DOCX, PDF, HTML, DOC, PNG, RTF, TXT
     *     RTF to DOCX, PDF, HTML, DOC, ODT, PNG, TXT
     *
     * msword method supports:
     *     DOCX to PDF, DOC
     *     PDF to DOCX, DOC
     *     DOC to DOCX, PDF
     *
     * @access public
     * @param string $source
     * @param string $target
     * @param string $method native, libreoffice, openoffice, msword
     * @param array $options
     * native method options:
     *   'dompdf' (DOMPDF): dompdf instance, needed to transform DOCX to PDF
     *   'stream' (bool): enable the stream mode. False as default
     *
     * libreoffice method options:
     *   'comments' (bool) : false (default) or true. Exports the comments
     *   'debug' (bool) : false (default) or true. Shows debug information about the plugin conversion
     *   'extraOptions' (string) : extra parameters to be used when doing the conversion
     *   'formsfields' (bool) : false (default) or true. Exports the form fields
     *   'homeFolder' (string) : set a custom home folder to be used for the conversions
     *   'lossless' (bool) : false (default) or true. Lossless compression
     *   'method' (string) : 'direct' (default), 'script' ; 'direct' method uses passthru and 'script' uses a external script. If you're using Apache and 'direct' doesn't work use 'script'
     *   'outdir' (string) : set the outdir path. Useful when the PDF output path is not the same than the running script
     *   'pdfa1' (bool) : false (default) or true. Generates PDF/A-1 document
     *   'toc' (bool) : false (default) or true. Generates the TOC before transforming the document
     *
     * msword method options:
     *    'selectedContent' (string) : documents or active (default)
     *    'toc' (bool) : false (default) or true. It generates the TOC before transforming the document
     *
     * openoffice method options:
     *   'debug' (bool) : false (default) or true. It shows debug information about the plugin conversion
     *   'homeFolder' (string) : set a custom home folder to be used for the conversions
     *   'method' (string) : 'direct' (default), 'script' ; 'direct' method uses passthru and 'script' uses a external script. If you're using Apache and 'direct' doesn't work use 'script'
     *   'odfconverter' (bool) : true (default) or false. Use odf-converter to preproccess documents
     *   'tempDir' (string) : uses a custom temp folder
     *   'version' (string) : 32-bit or 64-bit architecture. 32, 64 or null (default). If null autodetect
     *
     * @return void
     * @throws Exception method not available
     */
    public function transformDocument($source, $target, $method = null, $options = array())
    {
        if (file_exists(dirname(__FILE__) . '/TransformDocAdv.php')) {
            if (isset($this->_phpdocxconfig['transform']['method']) && $method === null) {
                $method = $this->_phpdocxconfig['transform']['method'];
            }

            switch ($method) {
                case 'native':
                    $convert = new TransformDocAdvNative();
                    $convert->transformDocument($source, $target, $options);
                    break;
                case 'msword':
                    $convert = new TransformDocAdvMSWord();
                    $convert->transformDocument($source, $target, $options);
                    break;
                case 'openoffice':
                    $convert = new TransformDocAdvOpenOffice();
                    $convert->transformDocument($source, $target, $options);
                    break;
                case 'libreoffice':
                default:
                    $convert = new TransformDocAdvLibreOffice();
                    $convert->transformDocument($source, $target, $options);
                    break;
            }
        } else {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }
    }

    /**
     * Transform OOML to MathML
     *
     * @param string $omml OMML
     * @param array $options
     * values:
     *  'cleanNamespaces' (bool) : true as default; removes the namespaces (mml and xmlns) of the output
     * @return string
     */
    public function transformOMMLToMathML($omml, $options = array()) {
        $rscXML = new DOMDocument();
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(false);
        }
        $rscXML->loadXML($omml);
        $objXSLTProc = new XSLTProcessor();
        $objXSL = new DOMDocument();
        $objXSL->load(dirname(__FILE__) . '/../xsl/OMML2MML.XSL');
        $objXSLTProc->importStylesheet($objXSL);

        $mathML = $objXSLTProc->transformToXML($rscXML);

        if (isset($options['cleanNamespaces']) && $options['cleanNamespaces'] == false) {
            return $mathML;
        } else {
            // remove namespaces
            return str_replace(array('mml:', 'xmlns:'), '', $mathML);
        }
    }

    /**
     * Translate chart option arrays to a predefined format
     * @param array $options
     * @access public
     * @static
     */
    public static function translateChartOptions2StandardFormat($options)
    {
        foreach ($options as $key => $value) {
            $options[strtolower($key)] = $value;
        }
        if (isset($options['chartAlign'])) {
            $options['jc'] = $options['chartAlign'];
        }
        return $options;
    }

    /**
     * Translate table option arrays to a predefined format
     * @param array $options
     * @access public
     * @static
     */
    public static function translateTableOptions2StandardFormat($options)
    {
        // general border options
        if (isset($options['borderColor'])) {
            $options['border_color'] = $options['borderColor'];
        }
        if (isset($options['borderSpacing'])) {
            $options['border_spacing'] = $options['borderSpacing'];
        }
        if (isset($options['borderWidth'])) {
            $options['border_sz'] = $options['borderWidth'];
            $options['border_width'] = $options['borderWidth'];
        }
        if (isset($options['borderSettings'])) {
            $options['border_settings'] = $options['borderSettings'];
        }
        // individual side options
        if (isset($options['borderTop'])) {
            $options['border_top'] = $options['borderTop'];
            $options['border_top_style'] = $options['borderTop'];
        }
        if (isset($options['borderRight'])) {
            $options['border_right'] = $options['borderRight'];
            $options['border_right_style'] = $options['borderRight'];
        }
        if (isset($options['borderBottom'])) {
            $options['border_bottom'] = $options['borderBottom'];
            $options['border_bottom_style'] = $options['borderBottom'];
        }
        if (isset($options['borderLeft'])) {
            $options['border_left'] = $options['borderLeft'];
            $options['border_left_style'] = $options['borderLeft'];
        }
        if (isset($options['borderTopWidth'])) {
            $options['border_top_sz'] = $options['borderTopWidth'];
            $options['border_top_width'] = $options['borderTopWidth'];
        }
        if (isset($options['borderRightWidth'])) {
            $options['border_right_sz'] = $options['borderRightWidth'];
            $options['border_right_width'] = $options['borderRightWidth'];
        }
        if (isset($options['borderBottomWidth'])) {
            $options['border_bottom_sz'] = $options['borderBottomWidth'];
            $options['border_bottom_width'] = $options['borderBottomWidth'];
        }
        if (isset($options['borderLeftWidth'])) {
            $options['border_left_sz'] = $options['borderLeftWidth'];
            $options['border_left_width'] = $options['borderLeftWidth'];
        }
        if (isset($options['borderTopColor'])) {
            $options['border_top_color'] = $options['borderTopColor'];
        }
        if (isset($options['borderRightColor'])) {
            $options['border_right_color'] = $options['borderRightColor'];
        }
        if (isset($options['borderBottomColor'])) {
            $options['border_bottom_color'] = $options['borderBottomColor'];
        }
        if (isset($options['borderLeftColor'])) {
            $options['border_left_color'] = $options['borderLeftColor'];
        }
        if (isset($options['borderTopSpacing'])) {
            $options['border_top_spacing'] = $options['borderTopSpacing'];
        }
        if (isset($options['borderRightSpacing'])) {
            $options['border_right_spacing'] = $options['borderRightSpacing'];
        }
        if (isset($options['borderBottomSpacing'])) {
            $options['border_bottom_spacing'] = $options['borderBottomSpacing'];
        }
        if (isset($options['borderLeftSpacing'])) {
            $options['border_left_spacing'] = $options['borderLeftSpacing'];
        }
        // column sizes
        if (isset($options['columnWidths'])) {
            $options['size_col'] = $options['columnWidths'];
        }
        // text margins
        if (isset($options['float']['tableMarginTop'])) {
            $options['float']['textMargin_top'] = $options['float']['tableMarginTop'];
        }
        if (isset($options['float']['tableMarginRight'])) {
            $options['float']['textMargin_right'] = $options['float']['tableMarginRight'];
        }
        if (isset($options['float']['tableMarginBottom'])) {
            $options['float']['textMargin_bottom'] = $options['float']['tableMarginBottom'];
        }
        if (isset($options['float']['tableMarginLeft'])) {
            $options['float']['textMargin_left'] = $options['float']['tableMarginLeft'];
        }
        // styles
        if (isset($options['tableAlign'])) {
            $options['jc'] = $options['tableAlign'];
        }
        if (isset($options['tableStyle'])) {
            $options['TBLSTYLEval'] = $options['tableStyle'];
        }
        if (isset($options['backgroundColor'])) {
            $options['background_color'] = $options['backgroundColor'];
        }
        return $options;
    }

    /**
     * Translate table option arrays to a predefined format
     * @param array $options
     * @access public
     * @static
     */
    public static function translateTextOptions2StandardFormat($options)
    {
        if (is_array($options)) {
            // general border options
            if (isset($options['border']) && $options['border'] == 'none') {
                $options['border'] = 'nil';
            }
            if (isset($options['borderColor'])) {
                $options['border_color'] = $options['borderColor'];
            }
            if (isset($options['borderSpacing'])) {
                $options['border_spacing'] = $options['borderSpacing'];
            }
            if (isset($options['borderWidth'])) {
                $options['border_sz'] = $options['borderWidth'];
            }
            if (isset($options['borderSettings'])) {
                $options['border_settings'] = $options['borderSettings'];
            }
            // individual side options
            if (isset($options['borderTop'])) {
                $options['border_top'] = $options['borderTop'];
                $options['border_top_style'] = $options['borderTop'];
            }
            if (isset($options['borderRight'])) {
                $options['border_right'] = $options['borderRight'];
                $options['border_right_style'] = $options['borderRight'];
            }
            if (isset($options['borderBottom'])) {
                $options['border_bottom'] = $options['borderBottom'];
                $options['border_bottom_style'] = $options['borderBottom'];
            }
            if (isset($options['borderLeft'])) {
                $options['border_left'] = $options['borderLeft'];
                $options['border_left_style'] = $options['borderLeft'];
            }
            if (isset($options['borderTopWidth'])) {
                $options['border_top_sz'] = $options['borderTopWidth'];
            }
            if (isset($options['borderRightWidth'])) {
                $options['border_right_sz'] = $options['borderRightWidth'];
            }
            if (isset($options['borderBottomWidth'])) {
                $options['border_bottom_sz'] = $options['borderBottomWidth'];
            }
            if (isset($options['borderLeftWidth'])) {
                $options['border_left_sz'] = $options['borderLeftWidth'];
            }
            if (isset($options['borderTopColor'])) {
                $options['border_top_color'] = $options['borderTopColor'];
            }
            if (isset($options['borderRightColor'])) {
                $options['border_right_color'] = $options['borderRightColor'];
            }
            if (isset($options['borderBottomColor'])) {
                $options['border_bottom_color'] = $options['borderBottomColor'];
            }
            if (isset($options['borderLeftColor'])) {
                $options['border_left_color'] = $options['borderLeftColor'];
            }
            if (isset($options['borderTopSpacing'])) {
                $options['border_top_spacing'] = $options['borderTopSpacing'];
            }
            if (isset($options['borderRightSpacing'])) {
                $options['border_right_spacing'] = $options['borderRightSpacing'];
            }
            if (isset($options['borderBottomSpacing'])) {
                $options['border_bottom_spacing'] = $options['borderBottomSpacing'];
            }
            if (isset($options['borderLeftSpacing'])) {
                $options['border_left_spacing'] = $options['borderLeftSpacing'];
            }
            // reassigned variables
            if (isset($options['indentLeft'])) {
                $options['indent_left'] = $options['indentLeft'];
            }
            if (isset($options['indentRight'])) {
                $options['indent_right'] = $options['indentRight'];
            }
            if (!empty($options['bold'])) {
                $options['b'] = 'on';
            }
            if (!empty($options['italic'])) {
                $options['i'] = 'on';
            }
            if (!empty($options['lineSpacing'])) {
                //$options['lineSpacing'] = ceil($options['lineSpacing'] * 240);
            }

            if (isset($options['fontSize'])) {
                $options['sz'] = $options['fontSize'];
            }
            if (isset($options['underline'])) {
                $options['u'] = $options['underline'];
            }
            if (isset($options['textAlign'])) {
                $options['jc'] = $options['textAlign'];
            }
            // translate to boolean
            if (!empty($options['bidi'])) {
                $options['bidi'] = 'on';
            }
            if (!empty($options['caps'])) {
                $options['caps'] = 'on';
            }
            if (!empty($options['keepLines'])) {
                $options['keepLines'] = 'on';
            }
            if (!empty($options['keepNext'])) {
                $options['keepNext'] = 'on';
            }
            if (!empty($options['pageBreakBefore'])) {
                $options['pageBreakBefore'] = 'on';
            }
            if (!empty($options['smallCaps'])) {
                $options['smallCaps'] = 'on';
            }
            if (!empty($options['widowControl'])) {
                $options['widowControl'] = 'on';
            }
            if (!empty($options['wordWrap'])) {
                $options['wordWrap'] = 'on';
            }
        }
        return $options;
    }

    /**
     *
     * Insert the content of a text file into a word document trying to hold the styles
     *
     * @param string $path. Path to the text file from which we insert into docx document
     * @param array of style values
     * keys: styleTbl, styleLst, styleP
     */
    public function txt2docx($text_filename, $options = array())
    {
        $text = new Text2Docx($text_filename, $options);
        PhpdocxLogger::logger('Add text from text file.', 'info');
        $this->_wordDocumentC .= (string) $text;
    }

    /**
     * Embeds a DOCX
     *
     * @access public
     * @param array $options
     * Values:
     * 'src' (string) path to DOCX
     * 'matchSource' (bool) if true (default value)tries to preserve as much as posible the styles of the docx to be included
     * 'preprocess' (bool) if true does some preprocessing on the docx file to add
     *  WARNING: beware that the docx to insert gets modified so please make a safeguard copy first
     * @throws Exception file does not exist
     */
    protected function addDOCX($options)
    {
        if (!isset($options['matchSource'])) {
            $options['matchSource'] = true;
        }
        if (!isset($options['preprocess'])) {
            $options['preprocess'] = false;
        }
        $class = get_class($this);
        try {
            if (file_exists($options['src'])) {
                // if preprocess is true we do certain previous manipulation on the docx to embed
                if ($options['preprocess']) {
                    $this->preprocessDocx($options['src']);
                }
                $wordDOCX = EmbedDOCX::getInstance();
                if (isset($options['matchSource']) && $options['matchSource'] === false) {
                    $wordDOCX->embed(false);
                } else {
                    $wordDOCX->embed(true);
                }
                PhpdocxLogger::logger('Add DOCX file to word document.', 'info');

                $this->_zipDocx->addFile('word/docx' . $wordDOCX->getId() . '.zip', $options['src']);
                $this->generateRELATIONSHIP(
                        'rDOCXId' . $wordDOCX->getId(), 'aFChunk', 'docx' .
                        $wordDOCX->getId() . '.zip', 'TargetMode="Internal"');
                $this->generateDEFAULT('zip', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document.main+xml');
                if ($class == 'WordFragment') {
                    $this->wordML .= (string) $wordDOCX . '<w:p />';
                } else {
                    $this->_wordDocumentC .= (string) $wordDOCX;
                }
            } else {
                throw new Exception('File does not exist.');
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
    }

    /**
     * Inserts HTML into a document as alternative content (altChunk).
     * This method IS NOT compatible with PDF conversion or Open Office (use embedHTML instead).
     *
     * @access private
     * @param array $options
     * Values:
     * 'html' (string)
     * @throws Exception file does not exist
     */
    protected function addHTML($options)
    {
        $class = get_class($this);
        try {
            $wordHTML = EmbedHTML::getInstance();
            $wordHTML->embed();
            PhpdocxLogger::logger('Embed HTML to word document.', 'info');
            $this->_zipDocx->addContent('word/html' . $wordHTML->getId() . '.htm', '<html>' . file_get_contents($options['src']) . '</html>');
            $this->generateRELATIONSHIP(
                    'rHTMLId' . $wordHTML->getId(), 'aFChunk', 'html' .
                    $wordHTML->getId() . '.htm', 'TargetMode="Internal"');
            $this->generateDEFAULT('htm', 'application/xhtml+xml');
            if ($class == 'WordFragment') {
                $this->wordML .= (string) $wordHTML . '<w:p/>';
            } else {
                $this->_wordDocumentC .= (string) $wordHTML;
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
    }

    /**
     * Create Images Caption
     *
     * @access protected
     */
    protected function addImageCaption($isWordFragment, $data)
    {
        if (!isset($data['styleName'])) {
            $data['styleName'] = 'Caption';
        }
        $nameBookmark = '_GoBack';
        if (isset($data['bookmarkName'])) {
            $nameBookmark = $data['bookmarkName'];
        }

        $caption =  CreateImageCaption::getInstance();
        $caption->initCaption($data);
        $caption->createCaption();
        $bookmarkStart = new WordFragment();
        $bookmarkStart->addBookmark(array('type' => 'start', 'name' => $nameBookmark));
        $bookmarkEnd = new WordFragment();
        $bookmarkEnd->addBookmark(array('type' => 'end', 'name' => $nameBookmark));

        if (!isset($data['align'])) {
            $data['align'] = 'left';
        }
        if (!isset($data['color'])) {
            $data['color'] = '1F497D';
        }
        if (!isset($data['lineSpacing'])) {
            $data['lineSpacing'] = 240;
        }
        if (!isset($data['sz'])) {
            $data['sz'] = 18;
        }

        $options = array(
            'color' => $data['color'],
            'lineSpacing' => $data['lineSpacing'],
            'jc' => $data['align'],
            'sz' => $data['sz'],
        );

        // check if the Caption style exists, create it otherwise
        $stylesXpath = new DOMXPath($this->_wordStylesT);
        $stylesXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $queryStyle = '//w:style[@w:styleId="'.$data['styleName'].'"]';
        $styleCaption = $stylesXpath->query($queryStyle);
        if ($styleCaption->length == 0) {
            $this->createParagraphStyle($data['styleName'], $options);
        }

        $caption = str_replace('</w:pPr>', '</w:pPr>' . (string) $bookmarkStart, (string) $caption);
        $caption = str_replace('__PHX=__GENERATESUBR__', (string) $bookmarkEnd, (string) $caption);
        $contentElement = (string)$caption;

        if (self::$trackingEnabled == true) {
            $tracking = new Tracking();
            $contentElement = $tracking->addTrackingInsR($contentElement);
        }

        if ($isWordFragment) {
            $this->wordML .= $contentElement;
        } else {
            $this->_wordDocumentC .= $contentElement;
        }

        // increment caption IDs to don't repeat the same ID
        $styleNameCaption = $data['styleName'];
        if (isset(self::$captionsIds[$styleNameCaption])) {
            self::$captionsIds[$styleNameCaption]++;
        } else {
            self::$captionsIds[$styleNameCaption] = 1;
        }
    }

    /**
     * Add a MHT file
     *
     * @access private
     * @param array $options
     * Values:
     * 'src' (string) path to the MHT file
     * @throws Exception file does not exist
     */
    protected function addMHT($options)
    {
        $class = get_class($this);
        try {
            if (file_exists($options['src'])) {
                $wordMHT = EmbedMHT::getInstance();
                $wordMHT->embed();
                PhpdocxLogger::logger('Add MHT file to word document.', 'info');
                $this->_zipDocx->addFile('word/mht' . $wordMHT->getId() . '.mht', $options['src']);
                $this->generateRELATIONSHIP(
                        'rMHTId' . $wordMHT->getId(), 'aFChunk', 'mht' .
                        $wordMHT->getId() . '.mht', 'TargetMode="Internal"');
                $this->generateDEFAULT('mht', 'message/rfc822');
                if ($class == 'WordFragment') {
                    $this->wordML .= (string) $wordMHT . '<w:p />';
                } else {
                    $this->_wordDocumentC .= (string) $wordMHT;
                }
            } else {
                throw new Exception('File does not exist.');
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
    }

    /**
     * Add a RTF file. Keep content and styles
     *
     * @access public
     * @param array $options
     * Values:
     * 'src' (string) path to the RTF file
     * @throws Exception file does not exist
     */
    protected function addRTF($options = array())
    {
        $class = get_class($this);
        try {
            if (file_exists($options['src'])) {
                $wordRTF = EmbedRTF::getInstance();
                $wordRTF->embed();
                PhpdocxLogger::logger('Add RTF file to word document.', 'info');
                $this->saveToZip($options['src'], 'word/rtf' . $wordRTF->getId() .
                        '.rtf');
                $this->generateRELATIONSHIP(
                        'rRTFId' . $wordRTF->getId(), 'aFChunk', 'rtf' .
                        $wordRTF->getId() . '.rtf', 'TargetMode="Internal"');
                $this->generateDEFAULT('rtf', 'application/rtf');
                if ($class == 'WordFragment') {
                    $this->wordML .= (string) $wordRTF . '<w:p/>';
                } else {
                    $this->_wordDocumentC .= (string) $wordRTF;
                }
            } else {
                throw new Exception('File does not exist.');
            }
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
    }

    /**
     * Appends WordFragment into the document
     *
     * @access protected
     * @param mixed $wordFragment the WordML fragment that we wish to insert.
     * @throws Exception the content is not a WordFragment
     */
    protected function appendWordFragment($wordFragment)
    {
        if ($wordFragment instanceof WordFragment) {
            PhpdocxLogger::logger('Insertion of a WordFragment into the Word document', 'info');
            $this->_wordDocumentC .= (string) $wordFragment;
        } else if (empty($WordFragment)) {
            PhpdocxLogger::logger('There was no content to insert', 'info');
        } else {
            PhpdocxLogger::logger('You can only insert a WordFragment or the result of a DOCXPath query', 'fatal');
        }
    }

    /**
     * Apply math equation styles
     *
     * @access protected
     * @param string $equation
     * @param array $options
     * @return string
     */
    protected function applyMathEquationStyles($equation, $options)
    {
        $equationStyledDOM = new DOMDocument();
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $prevValueLibXmlInternalErrors = libxml_use_internal_errors(true);
        $equationStyledDOM->loadXML($equation);
        libxml_clear_errors();
        libxml_use_internal_errors($prevValueLibXmlInternalErrors);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }

        if (isset($options['bold']) || isset($options['italic'])) {
            $styleMPR = '';
            if (isset($options['bold']) && $options['bold']) {
                $styleMPR .= 'b';
            }
            if (isset($options['italic']) && $options['italic']) {
                $styleMPR .= 'i';
            }
            if (!isset($options['bold']) && !isset($options['italic'])) {
                $styleMPR = 'p';
            }
            $elementsMR = $equationStyledDOM->getElementsByTagName('m:r');
            if ($elementsMR->length > 0) {
                foreach ($elementsMR as $elementMR) {
                    $elementRPR = $elementMR->getElementsByTagName('m:rPr');
                    // w:rPR doesn't exist, create it
                    if ($elementRPR->length == 0) {
                        $elementTag = $elementMR->ownerDocument->createElement('m:rPr');
                        $elementMR->insertBefore($elementTag, $elementMR->firstChild);

                        $elementRPRItem = $elementTag;
                    } else {
                        $elementRPRItem = $elementRPR->item(0);
                    }

                    // add the style only if not exists, otherwise change it
                    $elementMSTY = $elementRPRItem->getElementsByTagName('m:sty');
                    if ($elementMSTY->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('m:sty');
                        $elementRPRItem->appendChild($elementTag);

                        $elementMSTYItem = $elementTag;
                    } else {
                        $elementMSTYItem = $elementMSTY->item(0);
                    }
                    $elementMSTYItem->setAttribute('m:val', $styleMPR);
                }
            }
        }

        if (isset($options['color'])) {
            $elementsMR = $equationStyledDOM->getElementsByTagName('m:r');
            if ($elementsMR->length > 0) {
                foreach ($elementsMR as $elementMR) {
                    $elementRPR = $elementMR->getElementsByTagName('w:rPr');
                    // w:rPR doesn't exist, create it
                    if ($elementRPR->length == 0) {
                        $elementTag = $elementMR->ownerDocument->createElement('w:rPr');
                        $elementMR->insertBefore($elementTag, $elementMR->firstChild);

                        $elementRPRItem = $elementTag;
                    } else {
                        $elementRPRItem = $elementRPR->item(0);
                    }

                    // add the style only if not exists, otherwise change it
                    $elementColor = $elementRPRItem->getElementsByTagName('w:color');
                    if ($elementColor->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('w:color');
                        $elementRPRItem->appendChild($elementTag);

                        $elementColorItem = $elementTag;
                    } else {
                        $elementColorItem = $elementColor->item(0);
                    }
                    $elementColorItem->setAttribute('w:val', $options['color']);
                }
            }
        }

        if (isset($options['fontSize'])) {
            $elementsMR = $equationStyledDOM->getElementsByTagName('m:r');
            if ($elementsMR->length > 0) {
                foreach ($elementsMR as $elementMR) {
                    $elementRPR = $elementMR->getElementsByTagName('w:rPr');
                    // w:rPR doesn't exist, create it
                    if ($elementRPR->length == 0) {
                        $elementTag = $elementMR->ownerDocument->createElement('w:rPr');
                        $elementMR->insertBefore($elementTag, $elementMR->firstChild);

                        $elementRPRItem = $elementTag;
                    } else {
                        $elementRPRItem = $elementRPR->item(0);
                    }

                    // add the style only if not exists, otherwise change it
                    $elementRPRSZ = $elementRPRItem->getElementsByTagName('w:sz');
                    $elementRPRSZCS = $elementRPRItem->getElementsByTagName('w:szCs');
                    if ($elementRPRSZ->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('w:sz');
                        $elementRPRItem->appendChild($elementTag);

                        $elementRPRSZItem = $elementTag;
                    } else {
                        $elementRPRSZItem = $elementRPRSZ->item(0);
                    }
                    $elementRPRSZItem->setAttribute('w:val', ((int)$options['fontSize'])*2);
                    if ($elementRPRSZCS->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('w:szCs');
                        $elementRPRItem->appendChild($elementTag);

                        $elementRPRSZCSItem = $elementTag;
                    } else {
                        $elementRPRSZCSItem = $elementRPRSZ->item(0);
                    }
                    $elementRPRSZCSItem->setAttribute('w:val', ((int)$options['fontSize'])*2);
                }
            }
        }

        if (isset($options['underline'])) {
            $elementsMR = $equationStyledDOM->getElementsByTagName('m:r');
            if ($elementsMR->length > 0) {
                foreach ($elementsMR as $elementMR) {
                    $elementRPR = $elementMR->getElementsByTagName('w:rPr');
                    // w:rPR doesn't exist, create it
                    if ($elementRPR->length == 0) {
                        $elementTag = $elementMR->ownerDocument->createElement('w:rPr');
                        $elementMR->insertBefore($elementTag, $elementMR->firstChild);

                        $elementRPRItem = $elementTag;
                    } else {
                        $elementRPRItem = $elementRPR->item(0);
                    }

                    // add the style only if not exists, otherwise change it
                    $elementU = $elementRPRItem->getElementsByTagName('w:u');
                    if ($elementU->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('w:u');
                        $elementRPRItem->appendChild($elementTag);

                        $elementUItem = $elementTag;
                    } else {
                        $elementUItem = $elementUItem->item(0);
                    }
                    $elementUItem->setAttribute('w:val', $options['underline']);
                }
            }
        }

        return $equationStyledDOM->saveXML($equationStyledDOM->documentElement);
    }

    /**
     * Clean template
     *
     * @access protected
     */
    protected function cleanTemplate()
    {
        PhpdocxLogger::logger('Remove existing template tags.', 'debug');
        $this->_wordDocumentT = preg_replace(
                '/__PHX=__[A-Z]+__/', '', $this->_wordDocumentT
        );
    }

    /**
     * Generates custom XML files if they don't exist
     *
     * @access protected
     */
    protected function generateCustomXMLFiles()
    {
        // check if the file has a customXML folder and the required files, otherwise create them
        $customXMLItemProps = $this->getFromZip('customXml/itemProps1.xml');
        if (!$customXMLItemProps) {
            $this->generateOVERRIDE('/customXml/itemProps1.xml', 'application/vnd.openxmlformats-officedocument.customXmlProperties+xml');

            $this->_zipDocx->addContent('customXml/itemProps1.xml', OOXMLResources::$item1PropsCustomXML);

            $customXMLItem1 = $this->getFromZip('customXml/item1.xml');
            if (!$customXMLItem1) {
                $this->_zipDocx->addContent('customXml/item1.xml', OOXMLResources::$item1CustomXML);
            }
            $customXMLItemRels = $this->getFromZip('customXml/_rels/item1.xml.rels');
            if (!$customXMLItemRels) {
                $this->_zipDocx->addContent('customXml/_rels/item1.xml.rels', OOXMLResources::$item1RelsCustomXML);
            }

            $this->generateRELATIONSHIP('rId' . rand(99999999, 999999999), 'customXml', '../customXml/item1.xml');

        }
    }

    /**
     * Generates a relationship entry for the custom properties XML file
     *
     * @access protected
     */
    protected function generateCUSTOMRELS()
    {
        // write the new Relationship node
        $strCustom = '<Relationship Id="rId' . self::uniqueNumberId(999, 9999) . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/custom-properties" Target="docProps/custom.xml" />';
        $tempNode = self::$relsRels->createDocumentFragment();
        $tempNode->appendXML($strCustom);
        self::$relsRels->documentElement->appendChild($tempNode);
    }

    /**
     * Generate DEFAULT
     *
     * @access protected
     */
    protected function generateDEFAULT($extension, $contentType)
    {
        $strContent = $this->_contentTypeT->saveXML();
        if (
            strpos($strContent, 'Extension="' . strtolower($extension)) === false
        ) {
            $strContentTypes = '<Default Extension="' . $extension . '" ContentType="' . $contentType . '"> </Default>';
            $tempNode = $this->_contentTypeT->createDocumentFragment();
            $tempNode->appendXML($strContentTypes);
            $this->_contentTypeT->documentElement->appendChild($tempNode);
        }
    }

    /**
     * Generate OVERRIDE
     *
     * @access protected
     * @param string $partName
     * @param string $contentType
     */
    protected function generateOVERRIDE($partName, $contentType)
    {
        $strContent = $this->_contentTypeT->saveXML();
        if (
                strpos($strContent, 'PartName="' . $partName . '"') === false
        ) {
            $strContentTypes = '<Override PartName="' . $partName . '" ContentType="' . $contentType . '" />';
            $tempNode = $this->_contentTypeT->createDocumentFragment();
            $tempNode->appendXML($strContentTypes);
            $this->_contentTypeT->documentElement->appendChild($tempNode);
        }
    }

    /**
     * Generate RELATIONSHIP
     *
     * @access protected
     */
    protected function generateRELATIONSHIP()
    {
        $arrArgs = func_get_args();

        if ($arrArgs[1] == 'vbaProject') {
            $type = 'http://schemas.microsoft.com/office/2006/relationships/vbaProject';
        } else if ($arrArgs[1] == 'commentsExtended' || $arrArgs[1] == 'people') {
            $type = 'http://schemas.microsoft.com/office/2011/relationships/' . $arrArgs[1];
        } else {
            $type = 'http://schemas.openxmlformats.org/officeDocument/2006/' .
                    'relationships/' . $arrArgs[1];
        }

        if (!isset($arrArgs[3])) {
            $nodeWML = '<Relationship Id="' . $arrArgs[0] . '" Type="' . $type .
                    '" Target="' . $arrArgs[2] . '"></Relationship>';
        } else {
            $nodeWML = '<Relationship Id="' . $arrArgs[0] . '" Type="' . $type .
                    '" Target="' . $arrArgs[2] . '" ' . $arrArgs[3] .
                    '></Relationship>';
        }
        $relsNode = $this->_wordRelsDocumentRelsT->createDocumentFragment();
        $relsNode->appendXML($nodeWML);
        $this->_wordRelsDocumentRelsT->documentElement->appendChild($relsNode);
    }

    /**
     * Modify/create the rels files for footnotes, endnotes and comments
     * @param string $type can be footnote, endnote or comment
     * @access protected
     * @throws Exception wrong note type
     */
    protected function generateRelsNotes($type)
    {
        if ($type == 'footnote') {
            $relsDOM = $this->_wordFootnotesRelsT;
        } else if ($type == 'endnote') {
            $relsDOM = $this->_wordEndnotesRelsT;
        } else if ($type == 'comment') {
            $relsDOM = $this->_wordCommentsRelsT;
        } else {
            PhpdocxLogger::logger('Wrong note type', 'fatal');
        }
        if (!empty(CreateDocx::$_relsNotesImage[$type])) {
            foreach (CreateDocx::$_relsNotesImage[$type] as $key => $value) {
                if (empty($value['name'])) {
                    $value['name'] = $value['rId'];
                }
                $nodeWML = '<Relationship Id="' . $value['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/img' . $value['name'] . '.' . $value['extension'] . '" ></Relationship>';
                $relsNode = $relsDOM->createDocumentFragment();
                $relsNode->appendXML($nodeWML);
                $relsDOM->documentElement->appendChild($relsNode);
            }
        }
        if (!empty(CreateDocx::$_relsNotesExternalImage[$type])) {
            foreach (CreateDocx::$_relsNotesExternalImage[$type] as $key => $value) {
                $nodeWML = '<Relationship Id="' . $value['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="' . $value['url'] . '" TargetMode="External" ></Relationship>';
                $relsNode = $relsDOM->createDocumentFragment();
                $relsNode->appendXML($nodeWML);
                $relsDOM->documentElement->appendChild($relsNode);
            }
        }
        if (!empty(CreateDocx::$_relsNotesLink[$type])) {
            foreach (CreateDocx::$_relsNotesLink[$type] as $key => $value) {
                $nodeWML = '<Relationship Id="' . $value['rId'] . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink" Target="' . $value['url'] . '" TargetMode="External" ></Relationship>';
                $relsNode = $relsDOM->createDocumentFragment();
                $relsNode->appendXML($nodeWML);
                $relsDOM->documentElement->appendChild($relsNode);
            }
        }

        if ($type == 'footnote') {
            $this->_wordFootnotesRelsT = $relsDOM;
        } else if ($type == 'endnote') {
            $this->_wordEndnotesRelsT = $relsDOM;
        } else if ($type == 'comment') {
            $this->_wordCommentsRelsT = $relsDOM;
        }
    }

    /**
     * Generate SECTPR
     *
     * @access protected
     * @param array $args Section style
     */
    protected function generateSECTPR($args = '')
    {
        $page = CreatePage::getInstance();
        $page->createSECTPR($args);
        $this->_wordDocumentC .= (string) $page;
    }

    /**
     * Generates an element in settings.xml
     *
     * @access protected
     * @throws Exception incorrect setting tag
     */
    protected function generateSetting($tag)
    {
        if ((!in_array($tag, OOXMLResources::$settings))) {
            PhpdocxLogger::logger('Incorrect setting tag', 'fatal');
        }
        $settingIndex = array_search($tag, OOXMLResources::$settings);
        $selectedElements = $this->_wordSettingsT->documentElement->getElementsByTagName($tag);
        if ($selectedElements->length == 0) {
            $settingsElement = $this->_wordSettingsT->createDocumentFragment();
            $settingsElement->appendXML('<' . $tag . ' xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" />');
            $childNodes = $this->_wordSettingsT->documentElement->childNodes;
            $index = false;
            foreach ($childNodes as $node) {
                $index = array_search($node->nodeName, OOXMLResources::$settings);
                if ($index > $settingIndex) {
                    $node->parentNode->insertBefore($settingsElement, $node);
                    break;
                }
            }
            // in case no node was found (pretty unlikely)we should append the node
            if (!$index) {
                $this->_wordSettingsT->documentElement->appendChild($settingsElement);
            }
        }
    }

    /**
     * Generate WordDocument XML template
     *
     * @access protected
     */
    protected function generateTemplateWordDocument()
    {
        if (count(CreateDocx::$insertNameSpaces) > 0) {
            $strxmlns = '';
            foreach (CreateDocx::$insertNameSpaces as $key => $value) {
                $strxmlns .= $key . '="' . $value . '" ';
            }
            $this->_documentXMLElement = str_replace('<w:document', '<w:document ' . $strxmlns, $this->_documentXMLElement);
        }
        $this->_wordDocumentC .= $this->_sectPr->saveXML($this->_sectPr->documentElement);
        if (!empty($this->_wordHeaderC)) {
            $this->_wordDocumentC = str_replace(
                    '__PHX=__GENERATEHEADERREFERENCE__', '<' . CreateDocx::NAMESPACEWORD . ':headerReference ' .
                    CreateDocx::NAMESPACEWORD . ':type="default" r:id="rId' .
                    $this->_idWords['header'] . '"></' .
                    CreateDocx::NAMESPACEWORD . ':headerReference>', $this->_wordDocumentC
            );
        }
        if (!empty($this->_wordFooterC)) {
            $this->_wordDocumentC = str_replace(
                    '__PHX=__GENERATEFOOTERREFERENCE__', '<' . CreateDocx::NAMESPACEWORD . ':footerReference ' .
                    CreateDocx::NAMESPACEWORD . ':type="default" r:id="rId' .
                    $this->_idWords['footer'] . '"></' .
                    CreateDocx::NAMESPACEWORD . ':footerReference>', $this->_wordDocumentC
            );
        }
        $this->_wordDocumentT = $this->_documentXMLElement .
                $this->_background .
                '<' . CreateDocx::NAMESPACEWORD . ':body>' .
                $this->_wordDocumentC .
                '</' . CreateDocx::NAMESPACEWORD . ':body>' .
                '</' . CreateDocx::NAMESPACEWORD . ':document>';
        $this->cleanTemplate();
    }

    /**
     * Generates a TitlePg element in SectPr
     *
     * @access protected
     * @param boolean $extraSections if true there is more than one section
     */
    protected function generateTitlePg($extraSections)
    {
        if ($extraSections) {
            $domDocument = $this->getDOMDocx();
            $sections = $domDocument->getElementsByTagName('sectPr');
            $firstSection = $sections->item(0);
            $foundNodes = $firstSection->getElementsByTagName('TitlePg');
            if ($foundNodes->length == 0) {
                $newSectNode = '<w:titlePg xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" />';
                $sectNode = $domDocument->createDocumentFragment();
                $sectNode->appendXML($newSectNode);
                $refNode = $firstSection->appendChild($sectNode);
            } else {
                $foundNodes->item(0)->setAttribute('val', 1);
            }
            $stringDoc = $domDocument->saveXML();
            $bodyTag = explode('<w:body>', $stringDoc);
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        } else {

            $foundNodes = $this->_sectPr->documentElement->getElementsByTagName('TitlePg');
            if ($foundNodes->length == 0) {
                $newSectNode = '<w:titlePg xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" />';
                $sectNode = $this->_sectPr->createDocumentFragment();
                $sectNode->appendXML($newSectNode);
                $refNode = $this->_sectPr->documentElement->appendChild($sectNode);
            } else {
                $foundNodes->item(0)->setAttribute('val', 1);
            }
        }
    }

    /**
     * Extracts a file from the template docx zip and returns it as an string or a DOMDocument/SimpleXMLElement object
     *
     * @access protected
     * @param string|ZipArchive|DOCXStructure $src the path of the file to be retrieved
     * @param string $type string, DOMDocument or SimpleXMLElement
     * @param ZipArchive object $zip
     * $return mixed
     * @throws Exception not valid type
     */
    protected function getFromZip($src, $type = 'string', $zip = '')
    {
        if ($zip instanceof ZipArchive) {
            $XMLData = $zip->getFromName($src);
        } else if ($zip instanceof DOCXStructure) {
            $XMLData = $zip->getContent($src);
        } else {
            $XMLData = $this->_zipDocx->getContent($src);
        }

        // return the data in the requested format
        if ($type == 'string') {
            return $XMLData;
        } else if ($type == 'DOMDocument') {
            if ($XMLData !== false) {
                $domDocument = new DOMDocument();
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $domDocument->loadXML($XMLData);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
                return $domDocument;
            } else {
                return false;
            }
        } else if ($type == 'SimpleXMLElement') {
            if ($XMLData !== false) {
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $simpleXML = simplexml_load_string($XMLData);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
            } else {
                return false;
            }
        } else {
            PhpdocxLogger::logger('getFromZip: The chosen type is not recognized', 'fatal');
        }
    }

    /**
     * Gets all section nodes present in the docx
     *
     * @access protected
     * @param array $sectionNumbers
     * @return string
     */
    protected function getSectionNodes($sectionNumbers)
    {
        $sectNodes = array();
        // get all sectPr sections that may exist
        // within $this->_wordDocumentC
        $this->_tempDocumentDOM = $this->getDOMDocx();
        $sections = $this->_tempDocumentDOM->getElementsByTagName('sectPr');
        foreach ($sections as $section) {
            $sectNodes[] = $section;
        }
        $sectNodes[] = $this->_sectPr->documentElement;

        $finalSectNodes = array();
        if (empty($sectionNumbers)) {
            $finalSectNodes = $sectNodes;
        } else {
            foreach ($sectionNumbers as $key => $value) {
                if (isset($sectNodes[$value - 1])) {
                    $finalSectNodes[] = $sectNodes[$value - 1];
                }
            }
        }
        return $finalSectNodes;
    }

    /**
     * Return a Word DOM content based on the target
     *
     * @access protected
     * @param string $target Target
     * @return array DOM
     */
    protected function getWordContentDOM($target = 'document')
    {
        if ($target == 'style') {
            $domDocument = $this->_wordStylesT;
        } elseif ($target == 'lastSection') {
            $domDocument = $this->_sectPr;
        } else {
            // document target
            $domDocument = $this->getDOMDocx();
        }

        $domXpath = new DOMXPath($domDocument);
        $domXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $domXpath->registerNamespace('wp', 'http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing');
        $domXpath->registerNamespace('a', 'http://schemas.openxmlformats.org/drawingml/2006/main');
        $domXpath->registerNamespace('c', 'http://schemas.openxmlformats.org/drawingml/2006/chart');
        $domXpath->registerNamespace('pic', 'http://schemas.openxmlformats.org/drawingml/2006/picture');

        return array($domDocument, $domXpath);
    }

    /**
     * Return an array with Word DOM contents headers and footers
     *
     * @access protected
     * @param string $target Target
     * @param array $referenceNode
     * @return array DOM
     */
    protected function getWordContentByRels($referenceNode = array())
    {
        // get sections
        if (!isset($referenceNode['reference']['sections'])) {
            $sectPrNodes = $this->getSectionNodes(null);
        } else {
            $sectPrNodes = $this->getSectionNodes($referenceNode['reference']['sections']);
        }

        $contents = array();

        if (count($sectPrNodes) > 0) {
            $indexIds = array();
            foreach ($sectPrNodes as $sectPrNode) {
                $sectionRels = new DOMDocument();
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $namespaces = 'xmlns:ve="http://schemas.openxmlformats.org/markup-compatibility/2006" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing" xmlns:w10="urn:schemas-microsoft-com:office:word" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml" ';
                $wordMLSectPrNode = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?><w:root ' . $namespaces . '>' . $sectPrNode->ownerDocument->saveXML($sectPrNode) . '</w:root>';
                $sectionRels->loadXML($wordMLSectPrNode);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
                $sectionRelsXpath = new DOMXPath($sectionRels);
                $sectionRelsXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');

                $query = '//w:' . $referenceNode['target'] . 'Reference';
                $elementsReference = $sectionRelsXpath->query($query);

                // get reference IDs
                if ($elementsReference->length > 0) {
                    $i = 0;
                    foreach ($elementsReference as $elementReference) {
                        $i++;

                        // prevent duplicated Ids
                        if (in_array($elementReference->getAttribute('r:id'), $indexIds)) {
                            continue;
                        }

                        // add only the chosen types if 'types' is set
                        if (isset($referenceNode['reference']['types']) && is_array($referenceNode['reference']['types']) && !in_array($elementReference->getAttribute('w:type'), $referenceNode['reference']['types'])) {
                            continue;
                        }

                        // add only the chosen positions if 'positions' is set
                        if (isset($referenceNode['reference']['positions']) && is_array($referenceNode['reference']['positions']) && !in_array($i, $referenceNode['reference']['positions'])) {
                            continue;
                        }

                        $indexIds[] = $elementReference->getAttribute('r:id');
                    }
                }

                // get reference contents based on the IDs
                if (count($indexIds) > 0) {
                    $domDocumentRels = new DOMDocument();
                    if (PHP_VERSION_ID < 80000) {
                        $optionEntityLoader = libxml_disable_entity_loader(true);
                    }
                    $domDocumentRels->loadXML($this->_wordRelsDocumentRelsT->saveXML());
                    if (PHP_VERSION_ID < 80000) {
                        libxml_disable_entity_loader($optionEntityLoader);
                    }
                    $domDocumentRelsXpath = new DOMXPath($domDocumentRels);
                    $domDocumentRelsXpath->registerNamespace('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');

                    foreach ($indexIds as $indexId) {
                        $query = '//xmlns:Relationship[@Id="' . $indexId . '"]';
                        $elementsRelationship = $domDocumentRelsXpath->query($query);
                        if ($elementsRelationship->length > 0) {
                            $elementContent = $this->getWordFiles('word/' . $elementsRelationship->item(0)->getAttribute('Target'));

                            $domDocument = new DOMDocument();
                            if (PHP_VERSION_ID < 80000) {
                                $optionEntityLoader = libxml_disable_entity_loader(true);
                            }
                            $domDocument->loadXML($elementContent);
                            if (PHP_VERSION_ID < 80000) {
                                libxml_disable_entity_loader($optionEntityLoader);
                            }

                            $domXpath = new DOMXPath($domDocument);
                            $domXpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                            $domXpath->registerNamespace('wp', 'http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing');
                            $domXpath->registerNamespace('a', 'http://schemas.openxmlformats.org/drawingml/2006/main');
                            $domXpath->registerNamespace('c', 'http://schemas.openxmlformats.org/drawingml/2006/chart');
                            $domXpath->registerNamespace('pic', 'http://schemas.openxmlformats.org/drawingml/2006/picture');

                            $contents[] = array(
                                'document' => $domDocument,
                                'documentXpath' => $domXpath,
                                'target' => 'word/' . $elementsRelationship->item(0)->getAttribute('Target'),
                            );
                        }
                    }
                }
            }
        }

        return $contents;
    }

    /**
     * Return a Word content query based on the reference
     *
     * @access protected
     * @param array $referenceNode
     * Keys and values:
     *     'type' (string) can be * (all, default value), break, chart, endnote (content reference), footnote (content reference), image, list, paragraph (also for bookmarks, links and lists), section, shape, table, tracking-insert, tracking-delete, tracking-run-style, tracking-paragraph-style, tracking-table-style, tracking-table-grid, tracking-table-row
     *     'contains' (string) for list, paragraph (text, bookmark, link), shape
     *     'occurrence' (int) exact occurrence or (string) range of contents (e.g.: 2..9, 2.., ..9) or first() or last(), if empty iterate all elements
     *     'attributes' (array)
     *     'parent' (string) w:body (default), '/' (any parent) or any other specific parent (/w:tbl/, /w:tc/, /w:r/...)
     *     'customQuery' (string) if set overwrites all previous references. It must be a valid XPath query
     * @return DOM|null
     * @throws Exception method not available
     */
    protected function getWordContentQuery($referenceNode)
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // choose the reference node based on content
        if (!isset($referenceNode['type'])) {
            $referenceNode['type'] = '*';
        }

        if (isset($referenceNode['customQuery']) && !empty($referenceNode['customQuery'])) {
            $query = $referenceNode['customQuery'];
        } else {
            $query = DOCXPath::xpathContentQuery($referenceNode['type'], $referenceNode);
        }
        PhpdocxLogger::logger('DocxPath query: ' . $query, 'debug');

        return $query;
    }

    /**
     * Takes care of the links and images asociated with an HTML chunck processed
     * by the embedHTML method
     *
     * @access protected
     * @param array $sFinalDocX an arry with the required link and image data
     */
    protected function HTMLRels($sFinalDocX, $options)
    {
        $relsLinks = '';
        if ($options['target'] == 'defaultHeader' ||
                $options['target'] == 'firstHeader' ||
                $options['target'] == 'evenHeader' ||
                $options['target'] == 'defaultFooter' ||
                $options['target'] == 'firstFooter' ||
                $options['target'] == 'evenFooter') {
            foreach ($sFinalDocX[1] as $key => $value) {
                CreateDocx::$_relsHeaderFooterLink[$options['target']][] = array('rId' => $key, 'url' => $value);
            }
        } else if ($options['target'] == 'footnote' ||
                $options['target'] == 'endnote' ||
                $options['target'] == 'comment') {
            foreach ($sFinalDocX[1] as $key => $value) {
                CreateDocx::$_relsNotesLink[$options['target']][] = array('rId' => $key, 'url' => $value);
            }
        } else {
            foreach ($sFinalDocX[1] as $key => $value) {
                $relsLinks .= '<Relationship Id="' . $key . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink" Target="' . $value . '" TargetMode="External" />';
            }
            if ($relsLinks != '') {
                $relsNode = $this->_wordRelsDocumentRelsT->createDocumentFragment();
                $relsNode->appendXML($relsLinks);
                $this->_wordRelsDocumentRelsT->documentElement->appendChild($relsNode);
            }
        }

        $relsImages = '';

        if ($options['target'] == 'defaultHeader' ||
                $options['target'] == 'firstHeader' ||
                $options['target'] == 'evenHeader' ||
                $options['target'] == 'defaultFooter' ||
                $options['target'] == 'firstFooter' ||
                $options['target'] == 'evenFooter') {
            foreach ($sFinalDocX[2] as $key => $value) {
                $originalValue = $value;
                // remove the first three 'rId' characters in this case
                $valuesExplode = explode('?', $value);
                $value = array_shift($valuesExplode);
                if (isset($options['downloadImages']) && $options['downloadImages']) {
                    if (strstr($value, 'base64,')) {
                        // base64
                        $descrArray = explode(';base64,', $value);
                        $arrayExtension = explode('/', $descrArray[0]);
                        $extension = $arrayExtension[1];
                    } else {
                        $arrayExtension = explode('.', $value);
                        $extension = strtolower(array_pop($arrayExtension));
                    }
                    $predefinedExtensions = array('gif', 'png', 'jpg', 'jpeg', 'bmp');
                    if (!in_array($extension, $predefinedExtensions) && isset($value[0])) {
                        $arrayExtension = explode('.', $value[0]);
                        $extension = strtolower(array_pop($arrayExtension));
                    }
                    if (!in_array($extension, $predefinedExtensions)) {
                        $arrayExtension = explode('.', $originalValue);
                        $extension = strtolower(array_pop($arrayExtension));
                    }
                    if (!in_array($extension, $predefinedExtensions)) {
                        $this->generateDEFAULT($extension, 'image/' . $extension);
                    }

                    CreateDocx::$_relsHeaderFooterImage[$options['target']][] = array('rId' => $key, 'extension' => $extension);
                } else {
                    CreateDocx::$_relsHeaderFooterExternalImage[$options['target']][] = array('rId' => $key, 'url' => $value);
                }
            }
        } else if ($options['target'] == 'footnote' ||
                $options['target'] == 'endnote' ||
                $options['target'] == 'comment') {
            foreach ($sFinalDocX[2] as $key => $value) {
                $originalValue = $value;
                // remove the first three 'rId' characters in this case
                $valuesExplode = explode('?', $value);
                $value = array_shift($valuesExplode);
                if (isset($options['downloadImages']) && $options['downloadImages']) {
                    if (strstr($value, 'base64,')) {
                        // base64
                        $descrArray = explode(';base64,', $value);
                        $arrayExtension = explode('/', $descrArray[0]);
                        $extension = $arrayExtension[1];
                    } else {
                        $arrayExtension = explode('.', $value);
                        $extension = strtolower(array_pop($arrayExtension));
                    }
                    $predefinedExtensions = array('gif', 'png', 'jpg', 'jpeg', 'bmp');
                    if (!in_array($extension, $predefinedExtensions) && isset($value[0])) {
                        $arrayExtension = explode('.', $value[0]);
                        $extension = strtolower(array_pop($arrayExtension));
                    }
                    if (!in_array($extension, $predefinedExtensions)) {
                        $arrayExtension = explode('.', $originalValue);
                        $extension = strtolower(array_pop($arrayExtension));
                    }
                    if (!in_array($extension, $predefinedExtensions)) {
                        $this->generateDEFAULT($extension, 'image/' . $extension);
                    }

                    CreateDocx::$_relsNotesImage[$options['target']][] = array('rId' => $key, 'extension' => $extension);
                } else {
                    CreateDocx::$_relsNotesExternalImage[$options['target']][] = array('rId' => $key, 'url' => $value);
                }
            }
        } else {
            foreach ($sFinalDocX[2] as $key => $value) {
                $originalValue = $value;
                $valuesExplode = explode('?', $value);
                $value = array_shift($valuesExplode);
                if (isset($options['downloadImages']) && $options['downloadImages']) {
                    if (strstr($value, 'base64,')) {
                        // base64
                        $descrArray = explode(';base64,', $value);
                        $arrayExtension = explode('/', $descrArray[0]);
                        $extension = $arrayExtension[1];
                    } else {
                        $arrayExtension = explode('.', $value);
                        $extension = strtolower(array_pop($arrayExtension));
                    }
                    $predefinedExtensions = array('gif', 'png', 'jpg', 'jpeg', 'bmp');
                    if (!in_array($extension, $predefinedExtensions) && isset($value[0])) {
                        $arrayExtension = explode('.', $value[0]);
                        $extension = strtolower(array_pop($arrayExtension));
                    }
                    if (!in_array($extension, $predefinedExtensions)) {
                        $arrayExtension = explode('.', $originalValue);
                        $extension = strtolower(array_pop($arrayExtension));
                    }
                    if (!in_array($extension, $predefinedExtensions)) {
                        $this->generateDEFAULT($extension, 'image/' . $extension);
                    }
                    $relsImages .= '<Relationship Id="' . $key . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/img' . $key . '.' . $extension . '" />';
                } else {
                    $relsImages .= '<Relationship Id="' . $key . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="' . $value . '" TargetMode="External" />';
                }
            }

            if ($relsImages != '') {
                $relsNodeImages = $this->_wordRelsDocumentRelsT->createDocumentFragment();
                $relsNodeImages->appendXML($relsImages);
                $this->_wordRelsDocumentRelsT->documentElement->appendChild($relsNodeImages);
            }
        }
    }

    /**
     * Insert a Word fragment before a certain node
     *
     * @access protected
     * @param mixed $wordFragment the WordML fragment that we wish to insert.
     * it can be an instance of the WordFragment class or the result of a DOCXPath expression
     * @param DOMDocument $domDocument
     * @param string $source possible values are WordFragment or DocxPath
     * @param DOMNode $refNode
     * @param mixed $inlineLocation
     * @return void
     */
    protected function insertContentToDocument($wordFragment, $domDocument, $source, $refNode, $inlineLocation = false)
    {
        $cursor = $domDocument->createElement('cursor', 'WordFragment');
        if ($inlineLocation == 'inlineAfter') {
            $refNode->appendChild($cursor);
        } elseif ($inlineLocation == 'inlineBefore') {
            $refNode->insertBefore($cursor, $refNode->childNodes->item(1));
        } elseif ($inlineLocation == 'append') {
            $inlineLocation = false;

            $refNode->appendChild($cursor);
        } else {
            $refNode->parentNode->insertBefore($cursor, $refNode);
        }

        // get the WordFragment content with or without its main parent such as w:p
        $contentWordFragment = '';
        if ($inlineLocation == false) {
            $contentWordFragment = (string) $wordFragment;
        } else {
            $contentWordFragment = (string) $wordFragment->inlineWordML();
        }

        $stringDoc = $domDocument->saveXML();
        $bodyTag = explode('<w:body>', $stringDoc);
        $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        $this->_wordDocumentC = str_replace('<cursor>WordFragment</cursor>', $contentWordFragment, $this->_wordDocumentC);
    }

    /**
     * Insert a Word fragment before a certain node
     *
     * @access protected
     * @param mixed $wordFragment the WordML fragment that we wish to insert.
     * it can be an instance of the WordFragment class or the result of a DOCXPath expression
     * @param DOMDocument $domDocument
     * @param string $source possible values are WordFragment or DocxPath
     * @param string $target
     * @param DOMNode $refNode
     * @param mixed $inlineLocation
     * @return void
     */
    protected function insertContentToDocumentRels($wordFragment, $domDocument, $source, $target, $refNode, $inlineLocation = false)
    {
        $cursor = $domDocument->createElement('cursor', 'WordFragment');
        if ($inlineLocation == 'inlineAfter') {
            $refNode->appendChild($cursor);
        } elseif ($inlineLocation == 'inlineBefore') {
            $refNode->insertBefore($cursor, $refNode->childNodes->item(1));
        } elseif ($inlineLocation == 'append') {
            $inlineLocation = false;

            $refNode->appendChild($cursor);
        } else {
            $refNode->parentNode->insertBefore($cursor, $refNode);
        }

        // get the WordFragment content with or without its main parent such as w:p
        $contentWordFragment = '';
        if ($inlineLocation == false) {
            $contentWordFragment = (string) $wordFragment;
        } else {
            $contentWordFragment = (string) $wordFragment->inlineWordML();
        }

        $newContent = str_replace('<cursor>WordFragment</cursor>', $contentWordFragment, $domDocument->saveXML());
        $newContent = preg_replace('/__PHX=__[A-Z]+__/', '', $newContent);
        $this->saveToZip($newContent, $target);

        // add rels
        $nodes = $wordFragment->_wordRelsDocumentRelsT->getElementsBytagName('Relationship');
        $relName = str_replace('word/', 'word/_rels/', $target) . '.rels';
        $stringRels = $this->getFromZip($relName);
        if (!$stringRels) {
            $stringRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"></Relationships>';
        }
        foreach ($nodes as $node) {
            $nodeType = $node->getAttribute('Type');
            if ($nodeType == 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/image' || $nodeType == 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink' || $nodeType == 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/chart') {
                // only add the relation if the rId doesn't exist
                if (!strstr($stringRels, $wordFragment->_wordRelsDocumentRelsT->saveXML($node))) {
                    $xmlRels = new DOMDocument();
                    if (PHP_VERSION_ID < 80000) {
                        $optionEntityLoader = libxml_disable_entity_loader(true);
                    }
                    $xmlRels->loadXML($stringRels);
                    if (PHP_VERSION_ID < 80000) {
                        libxml_disable_entity_loader($optionEntityLoader);
                    }
                    $newRelNode = $xmlRels->createElement('relationship');
                    $xmlRels->getElementsBytagName('Relationships')->item(0)->appendChild($newRelNode);
                    $stringRels = $xmlRels->saveXML();
                    $stringRels = str_replace('<relationship/>', $wordFragment->_wordRelsDocumentRelsT->saveXML($node), $stringRels);
                }
            }
        }
        $this->saveToZip($stringRels, $relName);
    }

    /**
     * Modify the w:PageBorders sectPr property
     *
     * @access protected
     * @param DOMNode $sectionNode
     * @param array $options
     */
    protected function modifyPageBordersSectionProperty($sectionNode, $options)
    {
        // restart condition available types
        $display_types = array('allPages', 'firstPage', 'notFirstPage');
        $offset_types = array('page', 'text');
        $sides = array('top', 'left', 'bottom', 'right');
        $type = array('width' => 4, 'color' => '000000', 'style' => 'single', 'space' => 24);

        if (isset($options['borderStyle'])) {
            if (!(isset($options['border_top_style']))) {
                $options['border_top_style'] = $options['borderStyle'];
            }
            if (!(isset($options['border_right_style']))) {
                $options['border_right_style'] = $options['borderStyle'];
            }
            if (!(isset($options['border_bottom_style']))) {
                $options['border_bottom_style'] = $options['borderStyle'];
            }
            if (!(isset($options['border_left_style']))) {
                $options['border_left_style'] = $options['borderStyle'];
            }
        }

        // set default values
        if (isset($options['zOrder'])) {
            $zOrder = $options['zOrder'];
        } else {
            $zOrder = 1000;
        }
        if (isset($options['display']) && in_array($options['display'], $display_types)) {
            $display = $options['display'];
        } else {
            $display = 'allPages';
        }
        if (isset($options['offsetFrom']) && in_array($options['offsetFrom'], $offset_types)) {
            $offsetFrom = $options['offsetFrom'];
        } else {
            $offsetFrom = 'page';
        }
        foreach ($type as $key => $value) {
            foreach ($sides as $side) {
                if (isset($options['border_' . $side . '_' . $key])) {
                    $opt['border_' . $side . '_' . $key] = $options['border_' . $side . '_' . $key];
                } else if (isset($options['border_' . $key])) {
                    $opt['border_' . $side . '_' . $key] = $options['border_' . $key];
                } else {
                    $opt['border_' . $side . '_' . $key] = $value;
                }
            }
        }

        // if there is any previous pgBorders tag remove it
        if ($sectionNode->getElementsByTagName('pgBorders')->length > 0) {
            $pgBorder = $sectionNode->getElementsByTagName('pgBorders')->item(0);
            $pgBorder->parentNode->removeChild($pgBorder);
        }
        // insert the requested page borders
        $pgBordersNode = $sectionNode->ownerDocument->createDocumentFragment();
        $strNode = '<w:pgBorders ';
        $strNode .= 'xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" ';
        $strNode .= 'w:zOrder="' . $zOrder . '" w:display="' . $display . '" w:offsetFrom="' . $offsetFrom . '" >';
        foreach ($sides as $side) {
            $strNode .='<w:' . $side . ' w:val="' . $opt['border_' . $side . '_style'] . '" ';
            $strNode .= 'w:color="' . $opt['border_' . $side . '_color'] . '" ';
            $strNode .= 'w:sz="' . $opt['border_' . $side . '_width'] . '" ';
            $strNode .= 'w:space="' . $opt['border_' . $side . '_space'] . '" />';
        }
        $strNode .= '</w:pgBorders>';
        $pgBordersNode->appendXML($strNode);

        $propIndex = array_search('w:pgBorders', OOXMLResources::$sectionProperties);
        $childNodes = $sectionNode->childNodes;
        $index = false;
        foreach ($childNodes as $node) {
            $index = array_search($node->nodeName, OOXMLResources::$sectionProperties);
            if ($index > $propIndex) {
                $node->parentNode->insertBefore($pgBordersNode, $node);
                break;
            }
        }
        // in case no node was found we should append the node
        if (!$index) {
            $sectionNode->appendChild($pgBordersNode);
        }
    }

    /**
     * Modify a single sectPr property with no XML childs
     *
     * @access protected
     * @param DOMNode $sectionNode
     * @param string $tag name of the property we want to modify
     * @param array $options the corresponding attribute values
     */
    protected function modifySingleSectionProperty($sectionNode, $tag, $options, $nameSpace = 'w')
    {
        if ($sectionNode->getElementsByTagName($tag)->length > 0) {
            // node exists
            $node = $sectionNode->getElementsByTagName($tag);
            foreach ($options as $key => $value) {
                $node->item(0)->setAttribute($nameSpace . ':' . $key, $value);
            }
        } else {
            // otherwise create it
            $newNode = $sectionNode->ownerDocument->createDocumentFragment();
            $strNode = '<' . $nameSpace . ':' . $tag . ' ';
            foreach ($options as $key => $value) {
                $strNode .= $nameSpace . ':' . $key . '="' . $value . '" ';
            }
            if ($nameSpace == 'w') {
                $strNode .=' xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" ';
            }
            $strNode .='/>';
            $newNode->appendXML($strNode);

            $propIndex = array_search($nameSpace . ':' . $tag, OOXMLResources::$sectionProperties);
            $childNodes = $sectionNode->childNodes;
            $index = false;
            foreach ($childNodes as $node) {
                $name = $node->nodeName;
                $index = array_search($node->nodeName, OOXMLResources::$sectionProperties);
                if ($index > $propIndex) {
                    $node->parentNode->insertBefore($newNode, $node);
                    break;
                }
            }
            // in case no node was found we should append the node
            if (!$index) {
                $sectionNode->appendChild($newNode);
            }
        }
    }

    /**
     * Parse path dir
     *
     * @access protected
     * @param string $dir Directory path
     */
    protected function parsePath($dir)
    {
        $slash = 0;
        $path = '';
        if (($slash = strrpos($dir, '/')) !== false) {
            $slash += 1;
            $path = substr($dir, 0, $slash);
        }
        $punto = strpos(substr($dir, $slash), '.');

        $nombre = substr($dir, $slash, $punto);
        $extension = substr($dir, $punto + $slash + 1);

        // if the extension has more than one dot, get the last one
        if (strpos($extension, '.')) {
            $dotsExtension = explode('.', $extension);
            $extension = $dotsExtension[count($dotsExtension)-1];
        }

        return array(
            'path' => $path, 'nombre' => $nombre, 'extension' => $extension
        );
    }

    /**
     * Parses a WordML fragment to be inserted as a footnote or endnote
     *
     * @access protected
     * @param string $type it can be footnote, endnote or comment
     * @param WordFragment object $wordFragment
     * @param array $markOptions the note mark options
     * @param array $referenceOptions the note reference options
     * @return string
     */
    protected function parseWordMLNote($type, $wordFragment, $markOptions = array(), $referenceOptions = array())
    {
        $referenceOptions = self::translateTextOptions2StandardFormat($referenceOptions);
        $referenceOptions = self::setRTLOptions($referenceOptions);

        $strFrag = (string) $wordFragment;
        $basePIni = '<w:p><w:pPr><w:pStyle w:val="' . $type . 'TextPHPDOCX"/>';
        if (isset($referenceOptions['bidi']) && $referenceOptions['bidi']) {
            $basePIni .= '<w:bidi />';
        }
        $basePIni .= '</w:pPr>';
        $run = '<w:r><w:rPr><w:rStyle w:val="' . $type . 'ReferencePHPDOCX"/>';
        // parse the referenceMark options
        if (isset($referenceOptions['font'])) {
            $run .= '<w:rFonts w:ascii="' . $referenceOptions['font'] .
                    '" w:hAnsi="' . $referenceOptions['font'] .
                    '" w:eastAsia="' . $referenceOptions['font'] .
                    '" w:cs="' . $referenceOptions['font'] . '"/>';
        }
        if (isset($referenceOptions['b'])) {
            $run .= '<w:b w:val="' . $referenceOptions['b'] . '"/>';
            $run .= '<w:bCs w:val="' . $referenceOptions['b'] . '"/>';
        }
        if (isset($referenceOptions['i'])) {
            $run .= '<w:i w:val="' . $referenceOptions['i'] . '"/>';
            $run .= '<w:iCs w:val="' . $referenceOptions['i'] . '"/>';
        }
        if (isset($referenceOptions['color'])) {
            $run .= '<w:color w:val="' . $referenceOptions['color'] . '"/>';
        }
        if (isset($referenceOptions['sz'])) {
            $run .= '<w:sz w:val="' . (2 * $referenceOptions['sz']) . '"/>';
            $run .= '<w:szCs w:val="' . (2 * $referenceOptions['sz']) . '"/>';
        }
        if (isset($referenceOptions['rtl']) && $referenceOptions['rtl']) {
            $basePIni .= '<w:rtl />';
        }
        $run .= '</w:rPr>';
        if (isset($markOptions['customMark'])) {
            $run .= '<w:t>' . $markOptions['customMark'] . '</w:t>';
        } else {
            if ($type != 'comment') {
                $run .= '<w:' . $type . 'Ref/>';
            }
        }
        $run .= '</w:r>';
        $basePEnd = '</w:p>';
        // check if the WordML fragment starts with a paragraph
        $startFrag = substr($strFrag, 0, 5);
        if ($startFrag == '<w:p>') {
            $strFrag = preg_replace('/<\/w:pPr>/', '</w:pPr>' . $run, $strFrag, 1);
        } else {
            $strFrag = $basePIni . $run . $basePEnd . $strFrag;
        }
        return $strFrag;
    }

    /**
     * Preprocess a docx for the addDOCX method
     * By the time being we only remove the w:nsid and w:tmpl nodes from the
     * numbering.xml file
     *
     * @access protected
     * @param string $path path to file
     * @throws Exception file can't be open
     */
    protected function preprocessDocx($pathDOCX)
    {
        PhpdocxLogger::logger('Preprocess a docx for embeding with the addDOCX method.', 'debug');
        try {
            $embedZip = new ZipArchive();
            if ($embedZip->open($pathDOCX) === true) {
                // the docx was succesfully unzipped
            } else {
                throw new Exception(
                'it was not posible to unzip the docx file.'
                );
            }
            $numberingXML = $embedZip->getFromName('word/numbering.xml');
            $numberingDOM = new DOMDocument();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $numberingDOM->loadXML($numberingXML);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
            $numberingXPath = new DOMXPath($numberingDOM);
            $numberingXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
            // remove the w:nsid and w:tmpl elements to avoid conflicts
            $nsidQuery = '//w:nsid | //w:tmpl';
            $nsidNodes = $numberingXPath->query($nsidQuery);
            foreach ($nsidNodes as $node) {
                $node->parentNode->removeChild($node);
            }
            $newNumbering = $numberingDOM->saveXML();
            $embedZip->addFromString('word/numbering.xml', $newNumbering);
            $embedZip->close();
        } catch (Exception $e) {
            PhpdocxLogger::logger($e->getMessage(), 'fatal');
        }
    }

    /**
     * Regenerates a XML content based on its target after doing changes in it
     *
     * @access protected
     * @var string $target document (default), style, lastSection
     * @var DOMDocument $domDocument DOM document
     */
    protected function regenerateXMLContent($target = 'document', $domDocument = null)
    {
        if ($target == 'style') {
            $styleXML = $this->_wordStylesT->saveXML();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $this->_wordStylesT->loadXML($styleXML);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
        } elseif ($target == 'lastSection') {
            $sectionXML = $this->_sectPr->saveXML();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $this->_sectPr->loadXML($sectionXML);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
        } elseif ($target == 'document') {
            $stringDoc = $domDocument->saveXML();
            $bodyTag = explode('<w:body>', $stringDoc);
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            $this->_wordDocumentC = str_replace('<cursor>WordFragment</cursor>', '', $this->_wordDocumentC);
        }
    }

    /**
     * Remove a certain node in the document
     *
     * @access protected
     * @param DOMDocument $domDocument
     * @param DOMNode $refNode
     * @return void
     */
    protected function removeContentInDocument($domDocument, $refNode)
    {
        $refNodeXml = $domDocument->saveXML($refNode);
        $stringDoc = $domDocument->saveXML();
        $bodyTag = explode('<w:body>', $stringDoc);
        $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        $pos = strpos($this->_wordDocumentC, $refNodeXml);

        if ($pos !== false) {
            $this->_wordDocumentC = substr_replace($this->_wordDocumentC, '', $pos, strlen($refNodeXml));
        }
    }

    /**
     * Removes an element from settings.xml
     *
     * @access protected
     */
    protected function removeSetting($tag)
    {
        $settingsHeader = $this->_wordSettingsT->documentElement->getElementsByTagName($tag);
        if ($settingsHeader->length > 0) {
            $this->_wordSettingsT->documentElement->removeChild($settingsHeader->item(0));
        }
    }

    /**
     * Recovers as a well formatted string the $_wordDocumentC variable
     *
     * @access protected
     */
    protected function restoreDocumentXML()
    {
        $stringDoc = $this->_tempDocumentDOM->saveXML();
        $bodyTag = explode('<w:body>', $stringDoc);
        if (isset($bodyTag[1])) {
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        }
    }

    /**
     * Inserts data in different format into the docx template zip
     *
     * @access protected
     * @param mixed $src it can be a string, a DOMDocument object or a SimpleXMLElement object
     * @param string $target  path for the created file
     * @param ZipArchive object $zip
     * @return void|mixed
     * @throws Exception error inserting a file in the ZIP
     */
    protected function saveToZip($src, $target, &$zip = '')
    {
        if (!is_object($src) && @is_file(str_replace(chr(0), '', $src))) {
            // insert file into the zip
            try {
                $inserted = $this->_zipDocx->addFile($target, $src);
                if ($inserted === false) {
                    throw new Exception('Error while inserting the ' . $target . 'into the zip');
                }
            } catch (Exception $e) {
                PhpdocxLogger::logger($e->getMessage(), 'fatal');
            }
        } else {
            if (is_string($src)) {
                $XMLData = $src;
            } else if ($src instanceof DOMDocument) {
                $XMLData = $src->saveXML();
            } else if ($src instanceof SimpleXMLElement) {
                $XMLData = $src->asXML();
            } else {
                $XMLData = $src;
            }
            // insert the data into the zip
            try {
                $inserted = $this->_zipDocx->addContent($target, $XMLData);
                if ($inserted === false) {
                    throw new Exception('Error while inserting the ' . $target . 'into the zip');
                }
            } catch (Exception $e) {
                PhpdocxLogger::logger($e->getMessage(), 'fatal');
            }
        }
    }
}