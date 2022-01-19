<?php

namespace MindApps\LaravelSispag\Remessa\Cnab240;

use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Support\ServiceProvider;
use MindApps\LaravelSispag\Common\Util;

class Itau
{
    /**
     * @notes Picture variables
     */
    private static $PICTURE_ALPHANUMERIC        = 'X';
    private static $PICTURE_ALPHANUMERIC_MASKED = 'Z';
    private static $PICTURE_NUMERIC             = '9';
    private static $PICTURE_FLOAT               = 'V';

    /**
     * @notes Layout sections
     */
    public $HEADER_ARQUIVO;
    public $HEADER_LOTE;
    public $REGISTRO_DETALHE;
    public $REGISTRO_DETALHE_SEGMENTO_A;
    public $REGISTRO_DETALHE_SEGMENTO_B;
    public $REGISTRO_DETALHE_SEGMENTO_B_PIX;
    public $TRAILER_LOTE;
    public $TRAILER_ARQUIVO;
    public $CONTENT;


    /**
     * @notes Global variables
     */
    public $CODIGO_LOTE;


    /**
     * @notes construct function
     */
    public function __construct($CODIGO_LOTE)
    {
        $this->CODIGO_LOTE = $CODIGO_LOTE;

        $this->initHeaderArquivo();
        $this->initHeaderLote();
        $this->initRegistroDetalhe();
        $this->initRegistroDetalheSegmentoA();
        $this->initRegistroDetalheSegmentoB();
        $this->initRegistroDetalheSegmentoBPix();
        $this->initTrailerLote();
        $this->initTrailerArquivo();
    }

    /**
     * @notes return bank code
     *
     * @return array
     */
    public function getBankCode()
    {
        $className = (new \ReflectionClass($this))->getShortName();

        return Util::getBankCode($className);
    }


    /**
     * @notes return bank name
     *
     * @return array
     */
    public function getBankName()
    {
        $className = (new \ReflectionClass($this))->getShortName();

        return Util::getBankName($className);
    }


    /**
     * @notes Init $HEADER_ARQUIVO with variables
     *
     * @return void
     */
    public function initHeaderArquivo()
    {
        $HEADER_ARQUIVO = new \stdClass();
        $HEADER_ARQUIVO->codigoBanco      = ['position' => '001:003', 'picture' => self::$PICTURE_NUMERIC,      'value' => $this->getBankCode(), 'description' => 'CÓDIGO DO BCO NA COMPENSAÇÃO'];
        $HEADER_ARQUIVO->codigoLote       = ['position' => '004:007', 'picture' => self::$PICTURE_NUMERIC,      'value' => '0000', 'description' => 'LOTE DE SERVIÇO'];
        $HEADER_ARQUIVO->tipoRegistro     = ['position' => '008:008', 'picture' => self::$PICTURE_NUMERIC,      'value' => '0', 'description' => 'REGISTRO HEADER DE ARQUIVO'];
        $HEADER_ARQUIVO->brancos1         = ['position' => '009:014', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(6), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_ARQUIVO->layoutArquivo    = ['position' => '015:017', 'picture' => self::$PICTURE_NUMERIC,      'value' => '080', 'description' => 'Nº DA VERSÃO DO LAYOUT DO ARQUIVO'];
        $HEADER_ARQUIVO->empresaInscricao = ['position' => '018:018', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'TIPO DE INSCRIÇÃO DA EMPRESA. 1 = CPF, 2 = CNPJ'];
        $HEADER_ARQUIVO->inscricaoNumero  = ['position' => '019:032', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'CPF OU CNPJ DA EMPRESA'];
        $HEADER_ARQUIVO->brancos2         = ['position' => '033:052', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(20), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_ARQUIVO->agencia          = ['position' => '053:057', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'NÚMERO AGÊNCIA DEBITADA'];
        $HEADER_ARQUIVO->brancos3         = ['position' => '058:058', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(1), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_ARQUIVO->conta            = ['position' => '059:070', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'NÚMERO DA C/C DEBITADA (SEM DÍGITO VERIFICADOR)'];
        $HEADER_ARQUIVO->brancos4         = ['position' => '071:071', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(1), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_ARQUIVO->dac              = ['position' => '072:072', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'DÍGITO VERIFICADOR DA C/C DEBITADA'];
        $HEADER_ARQUIVO->nomeEmpresa      = ['position' => '073:102', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'NOME DA EMPRESA'];
        $HEADER_ARQUIVO->nomeBanco        = ['position' => '103:132', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => $this->getBankName(), 'description' => 'NOME DO BANCO'];
        $HEADER_ARQUIVO->brancos5         = ['position' => '133:142', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(10), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_ARQUIVO->arquivoCodigo    = ['position' => '143:143', 'picture' => self::$PICTURE_NUMERIC,      'value' => '1', 'description' => 'CÓDIGO REMESSA/RETORNO. 1 = REMESSA, 2 = RETORNO'];
        $HEADER_ARQUIVO->dataGeracao      = ['position' => '144:151', 'picture' => self::$PICTURE_NUMERIC,      'value' => Carbon::now()->format('dmY'), 'description' => 'DATA DA GERAÇÃO DO ARQUIVO. DDMMAAAA'];
        $HEADER_ARQUIVO->horaGeracao      = ['position' => '152:157', 'picture' => self::$PICTURE_NUMERIC,      'value' => Carbon::now()->format('His'), 'description' => 'HORA DA GERAÇÃO DO ARQUIVO. HHMMSS'];
        $HEADER_ARQUIVO->zeros1           = ['position' => '158:166', 'picture' => self::$PICTURE_NUMERIC,      'value' => Util::complementWithZero(9), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_ARQUIVO->unidadeDensidade = ['position' => '167:171', 'picture' => self::$PICTURE_NUMERIC,      'value' => Util::complementWithZero(5), 'description' => 'DENSIDADE DE GRAVAÇÃO DO ARQUIVO (PARA TELEPROCESSAMENTO, INCLUIR ZEROS)'];
        $HEADER_ARQUIVO->brancos6         = ['position' => '172:240', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(69), 'description' => 'COMPLEMENTO DE REGISTRO'];

        $this->HEADER_ARQUIVO = $HEADER_ARQUIVO;
    }


    /**
     * @notes Init $HEADER_LOTE with variables
     *
     * @return void
     */
    public function initHeaderLote()
    {
        $HEADER_LOTE = new \stdClass();
        $HEADER_LOTE->codigoBanco                = ['position' => '001:003', 'picture' => self::$PICTURE_NUMERIC,      'value' => $this->getBankCode(), 'description' => 'CÓDIGO DO BCO NA COMPENSAÇÃO'];
        $HEADER_LOTE->codigoLote                 = ['position' => '004:007', 'picture' => self::$PICTURE_NUMERIC,      'value' => $this->CODIGO_LOTE, 'description' => 'LOTE IDENTIFICAÇÃO DE PAGTOS'];
        $HEADER_LOTE->tipoRegistro               = ['position' => '008:008', 'picture' => self::$PICTURE_NUMERIC,      'value' => '1', 'description' => 'REGISTRO HEADER DE LOTE'];
        $HEADER_LOTE->tipoOperacao               = ['position' => '009:009', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => 'C', 'description' => 'TIPO DA OPERAÇÃO. C = CRÉDITO'];
        $HEADER_LOTE->tipoPagamento              = ['position' => '010:011', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'TIPO DE PAGTO (VERIFICAR TIPOS DE PAGAMENTO EM Extra/Itau()->getTipoPagamentoOptions())'];
        $HEADER_LOTE->formaPagamento             = ['position' => '012:013', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'FORMA DE PAGTO (VERIFICAR FORMAS DE PAGAMENTO EM Extra/Itau()->getFormaPagamentoOptions())'];
        $HEADER_LOTE->layoutLote                 = ['position' => '014:016', 'picture' => self::$PICTURE_NUMERIC,      'value' => '040', 'description' => 'Nº DA VERSÃO DO LAYOUT DO LOTE'];
        $HEADER_LOTE->brancos1                   = ['position' => '017:017', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(1), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_LOTE->empresaInscricao           = ['position' => '018:018', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'TIPO DE INSCRIÇÃO DA EMPRESA DEBITADA. 1 = CPF, 2 = CNPJ'];
        $HEADER_LOTE->inscricaoNumero            = ['position' => '019:032', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'CNPJ DA EMPRESA DEBITADA'];
        //identificacaoLancamento !!!
        $HEADER_LOTE->identificacaoLancamento    = ['position' => '033:036', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(4), 'description' => 'IDENTIFICAÇÃO DO LANÇAMENTO NO EXTRATO DO FAVORECIDO. NOTA 13 DA DOCUMENTAÇÃO'];
        $HEADER_LOTE->brancos2                   = ['position' => '037:052', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(16), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_LOTE->agencia                    = ['position' => '053:057', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'NÚMERO AGÊNCIA DEBITADA'];
        $HEADER_LOTE->brancos3                   = ['position' => '058:058', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(1), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_LOTE->conta                      = ['position' => '059:070', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'NÚMERO DA C/C DEBITADA (SEM DÍGITO VERIFICADOR)'];
        $HEADER_LOTE->brancos4                   = ['position' => '071:071', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(1), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_LOTE->dac                        = ['position' => '072:072', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'DÍGITO VERIFICADOR DA C/C DEBITADA'];
        $HEADER_LOTE->nomeEmpresa                = ['position' => '073:102', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'NOME DA EMPRESA'];
        $HEADER_LOTE->finalidadeLote             = ['position' => '103:132', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'FINALIDADE DOS PAGTOS DO LOTE (VERIFICAR FINALIDADES DO LOTE EM Extra/Itau()->getFinalidadeLoteOptions())'];
        $HEADER_LOTE->historicoContaCorrente     = ['position' => '133:142', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(10), 'description' => 'COMPLEMENTO HISTÓRICO C/C DEBITADA'];
        $HEADER_LOTE->enderecoEmpresa            = ['position' => '143:172', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'NOME DA RUA, AV, PÇA, ETC...'];
        $HEADER_LOTE->numeroEnderecoEmpresa      = ['position' => '173:177', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'NÚMERO DO LOCAL'];
        $HEADER_LOTE->complementoEnderecoEmpresa = ['position' => '178:192', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'CASA, APTO, SALA, ETC...'];
        $HEADER_LOTE->cidadeEnderecoEmpresa      = ['position' => '193:212', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'NOME DA CIDADE'];
        $HEADER_LOTE->cepEnderecoEmpresa         = ['position' => '213:220', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'CEP'];
        $HEADER_LOTE->estadoEnderecoEmpresa      = ['position' => '221:222', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'SIGLA DO ESTADO'];
        $HEADER_LOTE->brancos5                   = ['position' => '223:230', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(8), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $HEADER_LOTE->ocorrencias                = ['position' => '231:240', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(10), 'description' => 'CAMPO UTILIZADO APENAS NO ARQUIVO RETORNO PARA IDENTIFICAÇÃO DAS OCORRÊNCIAS DETECTADAS NO PROCESSAMENTO'];

        $this->HEADER_LOTE = $HEADER_LOTE;
    }


    /**
     * @notes Init $REGISTRO_DETALHE with variables
     *
     * @return void
     */
    public function initRegistroDetalhe()
    {
        $REGISTRO_DETALHE = [];

        $this->REGISTRO_DETALHE = $REGISTRO_DETALHE;
    }


    /**
     * @notes Init $REGISTRO_DETALHE_SEGMENTO_A with variables
     *
     * @return void
     */
    public function initRegistroDetalheSegmentoA()
    {
        $REGISTRO_DETALHE_SEGMENTO_A = new \stdClass();
        $REGISTRO_DETALHE_SEGMENTO_A->codigoBanco                = ['position' => '001:003', 'picture' => self::$PICTURE_NUMERIC,      'value' => $this->getBankCode(), 'description' => 'CÓDIGO DO BCO NA COMPENSAÇÃO'];
        $REGISTRO_DETALHE_SEGMENTO_A->codigoLote                 = ['position' => '004:007', 'picture' => self::$PICTURE_NUMERIC,      'value' => $this->CODIGO_LOTE, 'description' => 'LOTE IDENTIFICAÇÃO DE PAGTOS'];
        $REGISTRO_DETALHE_SEGMENTO_A->tipoRegistro               = ['position' => '008:008', 'picture' => self::$PICTURE_NUMERIC,      'value' => '3', 'description' => 'REGISTRO DETALHE DE LOTE'];
        $REGISTRO_DETALHE_SEGMENTO_A->numeroRegistro             = ['position' => '009:013', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'Nº SEQUENCIAL REGISTRO NO LOTE'];
        $REGISTRO_DETALHE_SEGMENTO_A->segmento                   = ['position' => '014:014', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => 'A', 'description' => 'SEGMENTO DO DETALHE DO LOTE'];
        $REGISTRO_DETALHE_SEGMENTO_A->tipoMovimento              = ['position' => '015:017', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'TIPO DE MOVIMENTO (VERIFICAR TIPOS DE MOVIMENTO EM Extra/Itau()->getTipoMovimentoOptions())'];
        $REGISTRO_DETALHE_SEGMENTO_A->camara                     = ['position' => '018:020', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'CÓDIGO DA CÂMARA CENTRALIZADORA'];
        $REGISTRO_DETALHE_SEGMENTO_A->bancoFavorecido            = ['position' => '021:023', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'CÓDIGO BANCO FAVORECIDO'];
        $REGISTRO_DETALHE_SEGMENTO_A->agenciaFavorecido          = ['position' => '024:028', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'AGÊNCIA DO FAVORECIDO'];
        $REGISTRO_DETALHE_SEGMENTO_A->brancos1                   = ['position' => '029:029', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(1), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_A->contaFavorecido            = ['position' => '030:041', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'CONTA DO FAVORECIDO'];
        $REGISTRO_DETALHE_SEGMENTO_A->brancos2                   = ['position' => '042:042', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(1), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_A->dacFavorecido              = ['position' => '043:043', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'DÍGITO VERIFICAR DA CONTA DO FAVORECIDO'];
        $REGISTRO_DETALHE_SEGMENTO_A->nomeFavorecido             = ['position' => '044:073', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'NOME DO FAVORECIDO'];
        $REGISTRO_DETALHE_SEGMENTO_A->seuNumero                  = ['position' => '074:093', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'Nº DOCTO ATRIBUÍDO PELA EMPRESA'];
        $REGISTRO_DETALHE_SEGMENTO_A->dataPagamento              = ['position' => '094:101', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'DATA PREVISTA PARA PAGTO - DDMMAAAA'];
        $REGISTRO_DETALHE_SEGMENTO_A->moedaTipo                  = ['position' => '102:104', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'TIPO DA MOEDA - REA OU 009'];
        $REGISTRO_DETALHE_SEGMENTO_A->codigoISPB                 = ['position' => '105:112', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'IDENTIFICAÇÃO DA INSTITUIÇÃO PARA O SPB. CONSULTA DISPONÍVEL EM https://www.bcb.gov.br/pom/spb/estatistica/port/ASTR003.pdf'];
        $REGISTRO_DETALHE_SEGMENTO_A->identificacaoTransferencia = ['position' => '113:114', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'CONTA PAGAMENTO / PIX. 01 - Conta corrente, PG - Conta Pagamento, 03 – Conta Poupança, 04 - Chave Pix'];
        $REGISTRO_DETALHE_SEGMENTO_A->zeros1                     = ['position' => '115:119', 'picture' => self::$PICTURE_NUMERIC,      'value' => Util::complementWithZero(5), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_A->valorPagamento             = ['position' => '120:134', 'picture' => self::$PICTURE_FLOAT,        'value' => null, 'description' => 'VALOR PREVISTO DO PAGTO'];
        $REGISTRO_DETALHE_SEGMENTO_A->nossoNumero                = ['position' => '135:149', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'Nº DOCTO ATRIBUÍDO PELO BANCO - DEVE SER PREENCHIDO APENAS EM CASO DE REGISTRO PARA CANCELAMENTO OU ALTERAÇÃO DE DATA DE PAGAMENTO'];
        $REGISTRO_DETALHE_SEGMENTO_A->brancos3                   = ['position' => '150:154', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(5), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_A->dataEfetiva                = ['position' => '155:162', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'DATA REAL EFETIVAÇÃO DO PAGTO - PREENCHIDO APENAS PELO ARQUIVO RETORNO'];
        $REGISTRO_DETALHE_SEGMENTO_A->valorEfetivo               = ['position' => '163:177', 'picture' => self::$PICTURE_FLOAT,        'value' => null, 'description' => 'VALOR REAL EFETIVAÇÃO DO PAGTO - PREENCHIDO APENAS PELO ARQUIVO RETORNO'];
        $REGISTRO_DETALHE_SEGMENTO_A->finalidadeDetalhe          = ['position' => '178:197', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'INFORMAÇÃO COMPLEMENTAR P/ HIST. DE C/C'];
        $REGISTRO_DETALHE_SEGMENTO_A->numeroDocumento            = ['position' => '198:203', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'Nº DO DOC/TED/ OP/ CHEQUE NO RETORNO'];
        $REGISTRO_DETALHE_SEGMENTO_A->inscricaoFavorecido        = ['position' => '204:217', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'Nº DE INSCRIÇÃO DO FAVORECIDO (CPF/CNPJ)'];
        $REGISTRO_DETALHE_SEGMENTO_A->finalidadeDocStatusFunc    = ['position' => '218:219', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'FINALIDADE DO DOC E STATUS DO FUNCIONÁRIO NA EMPRESA'];
        $REGISTRO_DETALHE_SEGMENTO_A->finalidadeTed              = ['position' => '220:224', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'FINALIDADE DA TED'];
        $REGISTRO_DETALHE_SEGMENTO_A->brancos4                   = ['position' => '225:229', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(5), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_A->avisoFavorecido            = ['position' => '230:230', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => null, 'description' => 'Apenas serão emitidos avisos para os tipos de pagamentos 20 (fornecedores) ou 98 (diversos)'];
        $REGISTRO_DETALHE_SEGMENTO_A->ocorrencias                = ['position' => '231:240', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(10), 'description' => 'CAMPO UTILIZADO APENAS NO ARQUIVO RETORNO PARA IDENTIFICAÇÃO DAS OCORRÊNCIAS DETECTADAS NO PROCESSAMENTO'];
        
        $this->REGISTRO_DETALHE_SEGMENTO_A = $REGISTRO_DETALHE_SEGMENTO_A;
    }


    /**
     * @notes Init $REGISTRO_DETALHE_SEGMENTO_B with variables
     *
     * @return void
     */
    public function initRegistroDetalheSegmentoB()
    {
        $REGISTRO_DETALHE_SEGMENTO_B = new \stdClass();
        $REGISTRO_DETALHE_SEGMENTO_B->codigoBanco                   = ['position' => '001:003', 'picture' => self::$PICTURE_NUMERIC,             'value' => $this->getBankCode(), 'description' => 'CÓDIGO DO BCO NA COMPENSAÇÃO'];
        $REGISTRO_DETALHE_SEGMENTO_B->codigoLote                    = ['position' => '004:007', 'picture' => self::$PICTURE_NUMERIC,             'value' => $this->CODIGO_LOTE, 'description' => 'LOTE IDENTIFICAÇÃO DE PAGTOS'];
        $REGISTRO_DETALHE_SEGMENTO_B->tipoRegistro                  = ['position' => '008:008', 'picture' => self::$PICTURE_NUMERIC,             'value' => '3', 'description' => 'REGISTRO DETALHE DE LOTE'];
        $REGISTRO_DETALHE_SEGMENTO_B->numeroRegistro                = ['position' => '009:013', 'picture' => self::$PICTURE_NUMERIC,             'value' => null, 'description' => 'Nº SEQUENCIAL REGISTRO NO LOTE'];
        $REGISTRO_DETALHE_SEGMENTO_B->segmento                      = ['position' => '014:014', 'picture' => self::$PICTURE_ALPHANUMERIC,        'value' => 'B', 'description' => 'SEGMENTO DO DETALHE DO LOTE'];
        $REGISTRO_DETALHE_SEGMENTO_B->brancos1                      = ['position' => '015:017', 'picture' => self::$PICTURE_ALPHANUMERIC,        'value' => Util::complementWithSpace(3), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_B->tipoInscricaoFavorecido       = ['position' => '018:018', 'picture' => self::$PICTURE_NUMERIC,             'value' => null, 'description' => 'TIPO INSCRIÇÃO DO FAVORECIDO. 1 = CPF, 2 = CNPJ'];
        $REGISTRO_DETALHE_SEGMENTO_B->numeroInscricaoFavorecido     = ['position' => '019:032', 'picture' => self::$PICTURE_NUMERIC,             'value' => null, 'description' => 'NÚMERO DE INSCRIÇÃO DO FAVORECIDO (CPF/CNPJ)'];
        $REGISTRO_DETALHE_SEGMENTO_B->enderecoFavorecido            = ['position' => '033:062', 'picture' => self::$PICTURE_ALPHANUMERIC,        'value' => null, 'description' => 'NOME DA RUA, AV, PÇA, ETC...'];
        $REGISTRO_DETALHE_SEGMENTO_B->numeroEnderecoFavorecido      = ['position' => '063:067', 'picture' => self::$PICTURE_NUMERIC,             'value' => null, 'description' => 'NÚMERO DO ENDEREÇO'];
        $REGISTRO_DETALHE_SEGMENTO_B->complementoEnderecoFavorecido = ['position' => '068:082', 'picture' => self::$PICTURE_ALPHANUMERIC,        'value' => null, 'description' => 'COMPLEMENTO DO ENDEREÇO'];
        $REGISTRO_DETALHE_SEGMENTO_B->bairroEnderecoFavorecido      = ['position' => '083:097', 'picture' => self::$PICTURE_ALPHANUMERIC,        'value' => null, 'description' => 'BAIRRO DO ENDEREÇO'];
        $REGISTRO_DETALHE_SEGMENTO_B->cidadeEnderecoFavorecido      = ['position' => '098:117', 'picture' => self::$PICTURE_ALPHANUMERIC,        'value' => null, 'description' => 'NOME DA CIDADE'];
        $REGISTRO_DETALHE_SEGMENTO_B->cepEnderecoFavorecido         = ['position' => '118:125', 'picture' => self::$PICTURE_NUMERIC,             'value' => null, 'description' => 'CEP'];
        $REGISTRO_DETALHE_SEGMENTO_B->estadoEnderecoFavorecido      = ['position' => '126:127', 'picture' => self::$PICTURE_ALPHANUMERIC,        'value' => null, 'description' => 'SIGLA DO ESTADO'];
        $REGISTRO_DETALHE_SEGMENTO_B->emailFavorecido               = ['position' => '128:227', 'picture' => self::$PICTURE_ALPHANUMERIC_MASKED, 'value' => null, 'description' => 'ENDEREÇO DE EMAIL DO FAVORECIDO'];
        $REGISTRO_DETALHE_SEGMENTO_B->brancos2                      = ['position' => '228:230', 'picture' => self::$PICTURE_ALPHANUMERIC,        'value' => Util::complementWithSpace(3), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_B->ocorrencias                   = ['position' => '231:240', 'picture' => self::$PICTURE_ALPHANUMERIC,        'value' => Util::complementWithSpace(10), 'description' => 'CAMPO UTILIZADO APENAS NO ARQUIVO RETORNO PARA IDENTIFICAÇÃO DAS OCORRÊNCIAS DETECTADAS NO PROCESSAMENTO'];

        $this->REGISTRO_DETALHE_SEGMENTO_B = $REGISTRO_DETALHE_SEGMENTO_B;
    }


    /**
     * @notes Init $REGISTRO_DETALHE_SEGMENTO_B_PIX with variables
     *
     * @return void
     */
    public function initRegistroDetalheSegmentoBPix()
    {
        $REGISTRO_DETALHE_SEGMENTO_B_PIX = new \stdClass();
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->codigoBanco                   = ['position' => '001:003', 'picture' => self::$PICTURE_NUMERIC,              'value' => $this->getBankCode(), 'description' => 'CÓDIGO DO BCO NA COMPENSAÇÃO'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->codigoLote                    = ['position' => '004:007', 'picture' => self::$PICTURE_NUMERIC,              'value' => $this->CODIGO_LOTE, 'description' => 'LOTE IDENTIFICAÇÃO DE PAGTOS'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->tipoRegistro                  = ['position' => '008:008', 'picture' => self::$PICTURE_NUMERIC,              'value' => '3', 'description' => 'REGISTRO DETALHE DE LOTE'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->numeroRegistro                = ['position' => '009:013', 'picture' => self::$PICTURE_NUMERIC,              'value' => null, 'description' => 'Nº SEQUENCIAL REGISTRO NO LOTE'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->segmento                      = ['position' => '014:014', 'picture' => self::$PICTURE_ALPHANUMERIC,         'value' => 'B', 'description' => 'SEGMENTO DO DETALHE DO LOTE'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->tipoChave                     = ['position' => '015:016', 'picture' => self::$PICTURE_ALPHANUMERIC,         'value' => null, 'description' => 'TIPO DE CHAVE PIX (VERIFICAR TIPOS DE CHAVE EM Extra/Itau()->getTipoChavePixOptions())'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->brancos1                      = ['position' => '017:017', 'picture' => self::$PICTURE_ALPHANUMERIC,         'value' => Util::complementWithSpace(1), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->tipoInscricaoFavorecido       = ['position' => '018:018', 'picture' => self::$PICTURE_NUMERIC,              'value' => null, 'description' => 'TIPO INSCRIÇÃO DO FAVORECIDO. 1 = CPF, 2 = CNPJ'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->numeroInscricaoFavorecido     = ['position' => '019:032', 'picture' => self::$PICTURE_NUMERIC,              'value' => null, 'description' => 'NÚMERO DE INSCRIÇÃO DO FAVORECIDO (CPF/CNPJ)'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->brancos2                      = ['position' => '033:062', 'picture' => self::$PICTURE_ALPHANUMERIC,         'value' => Util::complementWithSpace(30), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->informacaoEntreUsuarios       = ['position' => '063:127', 'picture' => self::$PICTURE_ALPHANUMERIC_MASKED,  'value' => null, 'description' => 'INFORMAÇÃO ENTRE USUARIOS'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->chavePix                      = ['position' => '128:227', 'picture' => self::$PICTURE_ALPHANUMERIC_MASKED,  'value' => null, 'description' => 'CHAVE DE ENDEREÇAMENTO PIX'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->brancos3                      = ['position' => '228:230', 'picture' => self::$PICTURE_ALPHANUMERIC,         'value' => Util::complementWithSpace(3), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $REGISTRO_DETALHE_SEGMENTO_B_PIX->ocorrencias                   = ['position' => '231:240', 'picture' => self::$PICTURE_ALPHANUMERIC,         'value' => Util::complementWithSpace(10), 'description' => 'CAMPO UTILIZADO APENAS NO ARQUIVO RETORNO PARA IDENTIFICAÇÃO DAS OCORRÊNCIAS DETECTADAS NO PROCESSAMENTO'];

        $this->REGISTRO_DETALHE_SEGMENTO_B_PIX = $REGISTRO_DETALHE_SEGMENTO_B_PIX;
    }


    /**
     * @notes Init $TRAILER_LOTE with variables
     *
     * @return void
     */
    public function initTrailerLote()
    {
        $TRAILER_LOTE = new \stdClass();
        $TRAILER_LOTE->codigoBanco                   = ['position' => '001:003', 'picture' => self::$PICTURE_NUMERIC,      'value' => $this->getBankCode(), 'description' => 'CÓDIGO DO BCO NA COMPENSAÇÃO'];
        $TRAILER_LOTE->codigoLote                    = ['position' => '004:007', 'picture' => self::$PICTURE_NUMERIC,      'value' => $this->CODIGO_LOTE, 'description' => 'LOTE IDENTIFICAÇÃO DE PAGTOS'];
        $TRAILER_LOTE->tipoRegistro                  = ['position' => '008:008', 'picture' => self::$PICTURE_NUMERIC,      'value' => '5', 'description' => 'REGISTRO TRAILER DE LOTE'];
        $TRAILER_LOTE->brancos1                      = ['position' => '009:017', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(9), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $TRAILER_LOTE->totalQuantidadeRegistros      = ['position' => '018:023', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'QUANTIDADE TOTAL DE REGISTROS DO TIPO 1, 3 E 5 PRESENTES NO ARQUIVO'];
        $TRAILER_LOTE->totalValorPagamento           = ['position' => '024:041', 'picture' => self::$PICTURE_FLOAT,        'value' => null, 'description' => 'VALOR TOTAL DA SOMATÓRIA DOS REGISTROS COM TIPO DE MOVIMENTO "000", "001", "002" OU "003" PRESENTES NO ARQUIVO'];
        $TRAILER_LOTE->zeros1                        = ['position' => '042:059', 'picture' => self::$PICTURE_NUMERIC,      'value' => Util::complementWithZero(18), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $TRAILER_LOTE->brancos2                      = ['position' => '060:230', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(171), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $TRAILER_LOTE->ocorrencias                   = ['position' => '231:240', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(10), 'description' => 'CAMPO UTILIZADO APENAS NO ARQUIVO RETORNO PARA IDENTIFICAÇÃO DAS OCORRÊNCIAS DETECTADAS NO PROCESSAMENTO'];

        $this->TRAILER_LOTE = $TRAILER_LOTE;
    }


    /**
     * @notes Init $TRAILER_ARQUIVO with variables
     *
     * @return void
     */
    public function initTrailerArquivo()
    {
        $TRAILER_ARQUIVO = new \stdClass();
        $TRAILER_ARQUIVO->codigoBanco                   = ['position' => '001:003', 'picture' => self::$PICTURE_NUMERIC,      'value' => $this->getBankCode(), 'description' => 'CÓDIGO DO BCO NA COMPENSAÇÃO'];
        $TRAILER_ARQUIVO->codigoLote                    = ['position' => '004:007', 'picture' => self::$PICTURE_NUMERIC,      'value' => '9999', 'description' => 'LOTE DE SERVIÇOS'];
        $TRAILER_ARQUIVO->tipoRegistro                  = ['position' => '008:008', 'picture' => self::$PICTURE_NUMERIC,      'value' => '9', 'description' => 'REGISTRO TRAILER DE ARQUIVO'];
        $TRAILER_ARQUIVO->brancos1                      = ['position' => '009:017', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(9), 'description' => 'COMPLEMENTO DE REGISTRO'];
        $TRAILER_ARQUIVO->totalQuantidadeLotes          = ['position' => '018:023', 'picture' => self::$PICTURE_NUMERIC,      'value' => '1', 'description' => 'QUANTIDADE TOTAL DE LOTES NO ARQUIVO'];
        $TRAILER_ARQUIVO->totalQuantidadeRegistros      = ['position' => '024:029', 'picture' => self::$PICTURE_NUMERIC,      'value' => null, 'description' => 'QUANTIDADE TOTAL DE REGISTROS DOS TIPOS 0, 1, 3, 5 E 9 NO ARQUIVO'];
        $TRAILER_ARQUIVO->brancos2                      = ['position' => '030:240', 'picture' => self::$PICTURE_ALPHANUMERIC, 'value' => Util::complementWithSpace(211), 'description' => 'COMPLEMENTO DE REGISTRO'];

        $this->TRAILER_ARQUIVO = $TRAILER_ARQUIVO;
    }


    /**
     * @notes Set values to section by key and value
     *
     * @param $params
     * @return void
     */
    public function setValues($section, $params)
    {
        if(!isset($this->{$section}))
        {
            throw new \Exception('Invalid section "'.$section.'"');
        }

        foreach($params as $key => $value)
        {
            if(!isset($this->{$section}->{$key}))
            {
                throw new \Exception('Invalid key "'.$key.'" on '.$section);
            }
            else
            {
                $args   = $this->{$section}->{$key};

                $args['value'] = $value;

                $this->{$section}->{$key} = $args;


            }
        }

        if(in_array($section,['REGISTRO_DETALHE_SEGMENTO_A','REGISTRO_DETALHE_SEGMENTO_B','REGISTRO_DETALHE_SEGMENTO_B_PIX']))
        {
            $registroDetalhe = clone $this->{$section};

            $this->REGISTRO_DETALHE[] = $registroDetalhe;
        }
    }


    /**
     * @notes Generate TXT File and save
     *
     * @param $directory
     * @param $filename
     * @return mixed
     */
    public function save($directory, $filename)
    {
        // Validate path
        if(!is_dir($directory))
        {
            throw new \Exception('Directory not found');
        }

        //validate total of data
        if(count($this->REGISTRO_DETALHE) == 0)
        {
            throw new \Exception('REGISTRO_DETALHE is empty');
        }

        // Generate content file
        $sections = [];
        $sections['HEADER_ARQUIVO'] = $this->HEADER_ARQUIVO;
        $sections['HEADER_LOTE'] = $this->HEADER_LOTE;

        $index = 1;
        foreach($this->REGISTRO_DETALHE as $item)
        {
            $sections['REGISTRO_DETALHE_'.$index] = $item;
            $index++;
        }

        $sections['TRAILER_LOTE'] = $this->TRAILER_LOTE;
        $sections['TRAILER_ARQUIVO'] = $this->TRAILER_ARQUIVO;

        $content = "";

        foreach ($sections as $sectionName => $sectionItems)
        {
            foreach($sectionItems as $args)
            {
                $value = $args['value'];

                // Get length of value, calculated by startPosition and endPosition
                list($startPosition, $endPosition) = explode(':',$args['position']);
                $length = (int) $endPosition - (int) $startPosition + 1;


                // Define padding char, padding type and format chars from value
                if($args['picture'] == self::$PICTURE_NUMERIC or $args['picture'] == self::$PICTURE_FLOAT)
                {
                    $padChar = '0';
                    $padType = 0; //STR_PAD_LEFT
                    $value   = Util::onlyNumbers($value);
                    $value   = Util::removeMask($value);
                }
                elseif($args['picture'] == self::$PICTURE_ALPHANUMERIC)
                {
                    $padChar = ' ';
                    $padType = 1; //STR_PAD_RIGHT
                    $value   = Util::removeSpecialChars($value);
                    $value   = Util::removeMask($value);
                    $value   = strtoupper($value);
                }
                elseif($args['picture'] == self::$PICTURE_ALPHANUMERIC_MASKED)
                {
                    $padChar = ' ';
                    $padType = 1; //STR_PAD_RIGHT
                    $value   = Util::removeSpecialChars($value);
                }

                // Define padding char, padding type and format chars from value
                $value = str_pad(
                    substr($value, 0, $length),
                    $length,
                    $padChar,
                    $padType
                );

                $content .= $value;
            }

            $content .= "\r\n";
        }


        // save content at new file
        $this->CONTENT = $content;

        $path = (substr($directory, -1) == '/' ? substr($directory,0,-1) : $directory) .'/'. $filename.'.txt';

        $file = fopen($path,'w+');
        fwrite($file, $content);
        fclose($file);

        return $path;
    }
}
