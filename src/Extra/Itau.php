<?php

namespace MindApps\LaravelSispag\Extra;


class Itau
{

    /**
     * @notes Return payment types for SISPAG Itaú
     *
     * @return string[]
     */
    public function getTipoPagamentoOptions()
    {
        $items = [
            '10' => '10 - DIVIDENDOS',
            '15' => '15 - DEBÊNTURES',
            '20' => '20 - FORNECEDORES',
            '22' => '22 - TRIBUTOS',
            '30' => '30 - SALÁRIOS',
            '40' => '40 - FUNDOS DE INVESTIMENTOS',
            '50' => '50 - SINISTROS DE SEGUROS',
            '60' => '60 - DESPESAS VIAJANTE EM TRÂNSITO',
            '80' => '80 - REPRESENTANTES AUTORIZADOS',
            '90' => '90 - BENEFÍCIOS',
            '98' => '98 - DIVERSOS',
        ];

        return $items;
    }


    /**
     * @notes Return payment methods for SISPAG Itaú
     *
     * @return string[]
     */
    public function getFormaPagamentoOptions()
    {
        $items = [
            '01' => '01 - CRÉDITO EM CONTA CORRENTE NO ITAÚ',
            '02' => '02 - CHEQUE PAGAMENTO/ADMINISTRATIVO',
            '03' => '03 - DOC “C”',
            '05' => '05 - CRÉDITO EM CONTA POUPANÇA NO ITAÚ',
            '06' => '06 - CRÉDITO EM CONTA CORRENTE DE MESMA TITULARIDADE',
            '07' => '07 - DOC “D”',
            '10' => '10 - ORDEM DE PAGAMENTO À DISPOSIÇÃO',
            '13' => '13 - PAGAMENTO DE CONCESSIONÁRIAS',
            '16' => '16 - DARF NORMAL',
            '17' => '17 - GPS - GUIA DA PREVIDÊNCIA SOCIAL',
            '18' => '18 - DARF SIMPLES',
            '19' => '19 - IPTU/ISS/OUTROS TRIBUTOS MUNICIPAIS',
            '22' => '22 - GARE – SP ICMS',
            '25' => '25 - IPVA',
            '27' => '27 - DPVAT',
            '30' => '30 - PAGAMENTO DE TÍTULOS EM COBRANÇA NO ITAÚ',
            '31' => '31 - PAGAMENTO DE TÍTULOS EM COBRANÇA EM OUTROS BANCOS',
            '32' => '32 - NOTA FISCAL – LIQUIDAÇÃO ELETRÔNICA',
            '35' => '35 - FGTS',
            '41' => '41 - TED – OUTRO TITULAR',
            '43' => '43 - TED – MESMO TITULAR',
            '45' => '45 - PIX TRANSFERÊNCIA',
            '47' => '47 - PIX QR-CODE',
            '60' => '60 - CARTÃO SALÁRIO',
            '91' => '91 - GNRE E TRIBUTOS COM CÓDIGO DE BARRAS',
        ];

        return $items;
    }


    /**
     * @notes Return finalities for SISPAG Itaú
     *
     * @return string[]
     */
    public function getFinalidadeLoteOptions()
    {
        $items = [
            /**
             * Notes:
             * Na contratação, não tendo sido acertada a sua utilização, este campo deverá ser
             * obrigatoriamente preenchido com brancos.
             * Se contratado, a mensagem constará em todos os avisos e documentos originados do lote,
             * desde que seja solicitado aviso ao favorecido conforme nota 16.
             * Quando se tratar de Conta de Investimento ou o tipo de pagamento for SISPAG Salários e tiver
             * sido contratado o serviço Holerite – Demonstrativo de Pagamentos / Informe de Rendimentos,
             * via 30 Horas / Auto-Atendimento, deverá ser indicado nas posições 103 a 104 o código
             * correspondente, conforme tabela abaixo:
             *
             */
            '01' => '01 - Folha Mensal',
            '02' => '02 - Folha Quinzenal',
            '03' => '03 - Folha Complementar',
            '04' => '04 - 13º Salário',
            '05' => '05 - Participação de Resultados',
            '06' => '06 - Informe de Rendimentos',
            '07' => '07 - Férias',
            '08' => '08 - Rescisão',
            '09' => '09 - Rescisão Complementar',
            '10' => '10 - Outros',
            '85' => '85 - Débito Conta Investimento',

            /*
             * Para pagamentos que envolvam Conta Investimento os campos Finalidade do Lote (Posições
             * 103 e 104 do Registro Header de Lote) e Finalidade TED (Posições 220 a 224 do Registro
             * Detalhe Segmento A - Nota 26), devem apresentar os seguintes conteúdos, de acordo com a
             * operação:
             */
            '00' => '00 - Débito em conta corrente (forma de pagamento “06”) com crédito em conta corrente e finalidade da TED "00000" ou brancos | Débito em conta corrente (formas de pagamento “06” ou “43”) com crédito em conta investimento e finalidade da TED "00016"',
            //'85' => '00 - Débito em conta investimento (forma de pagamento “06” ou “43”) com crédito em conta corrente e finalidade da TED "00000" ou brancos | Débito em conta investimento (formas de pagamento “06” ou “43”) com crédito em conta investimento e finalidade da TED "00016"',
        ];

        return $items;
    }


    /**
     * @notes Return finalities for SISPAG Itaú
     *
     * @return string[]
     */
    public function getFinalidadeTedOptions()
    {
        $items = [
            '00001' => '00001 - Pagamento de Impostos, Tributos e Taxas',
            '00002' => '00002 - Pagamento a Concessionárias de Serviço Público',
            '00003' => '00003 - Pagamento de Dividendos',
            '00004' => '00004 - Pagamento de Salários',
            '00005' => '00005 - Pagamento de Fornecedores',
            '00006' => '00006 - Pagamento de Honorários',
            '00007' => '00007 - Pagamento de Aluguéis e Taxas e Condomínio',
            '00008' => '00008 - Pagamento de Duplicatas e Títulos',
            '00009' => '00009 - Pagamento de Mensalidades Escolares',
            '00010' => '00010 - Crédito em Conta Corrente ou Conta Poupança',
            '00011' => '00011 - Pagamento a Corretoras',
            '00015' => '00015 - Liquidação Financeira Operadora Cartão de Crédito',
            '00016' => '00016 - Crédito em Conta Investimento',
            '00043' => '00043 - Lei Rouanet – Patrocínio',
            '00044' => '00044 - Lei Rouanet – Doação',
            '00100' => '00100 - Depósito Judicial',
            '00101' => '00101 - Pensão Alimentícia',
            '00200' => '00200 - Transferência Internacional de Reais',
            '00201' => '00201 - Ajuste Posição Mercado Futuro',
            '00204' => '00204 - Compra/Venda de Ações – Bolsas de Valores e Mercado de Balcão',
            '00205' => '00205 - Contrato referenciado em Ações/Índices de Ações – BV/BMF',
            '00300' => '00300 - Restituição de Imposto de Renda',
            '00500' => '00500 - Restituição de Prêmio de Seguros',
            '00501' => '00501 - Pagamento de indenização de Sinistro de Seguro',
            '00502' => '00502 - Pagamento de Prêmio de Co-seguro',
            '00503' => '00503 - Restituição de prêmio de Co-seguro',
            '00504' => '00504 - Pagamento de indenização de Co-seguro',
            '00505' => '00505 - Pagamento de prêmio de Resseguro',
            '00506' => '00506 - Restituição de prêmio de Resseguro',
            '00507' => '00507 - Pagamento de Indenização de Sinistro de Resseguro',
            '00508' => '00508 - Restituição de Indenização de Sinistro de Resseguro',
            '00509' => '00509 - Pagamento de Despesas com Sinistros',
            '00510' => '00510 - Pagamento de Inspeções/Vistorias Prévias',
            '00511' => '00511 - Pagamento de Resgate de Título de Capitalização',
            '00512' => '00512 - Pagamento de Sorteio de Título de Capitalização',
            '00513' => '00513 - Pagamento de Devolução de Mensalidade de Título de Capitalização',
            '00514' => '00514 - Restituição de Contribuição de Plano Previdenciário',
            '00515' => '00515 - Pagamento de Benefício Previdenciário de Pecúlio',
            '00516' => '00516 - Pagamento de Benefício Previdenciário de Pensão',
            '00517' => '00517 - Pagamento de Benefício Previdenciário de Aposentadoria',
            '00518' => '00518 - Pagamento de Resgate Previdenciário',
            '00519' => '00519 - Pagamento de Comissão de Corretagem',
            '00520' => '00520 - Pagamento de Transferências/Portabilidade de Reserva de Seguro/Previdência',
        ];

        return $items;
    }


    /**
     * @notes Return types of data for SISPAG Itaú
     *
     * @return string[]
     */
    public function getTipoMovimentoOptions()
    {
        $items = [
            '000' => '000 - Inclusão de pagamento',
            '001' => '001 - CPF',
            '002' => '002 - CNPJ (completo)',
            '003' => '003 - CNPJ (raiz)',
            '004' => '004 - Inclusão de Demonstrativo de Pagamento/Holerite',
            '512' => '512 - Alteração do Demonstrativo de Pagamentos/Holerite',
            '517' => '517 - Alteração de Valor do Pagamento',
            '519' => '519 - Alteração da Data de Pagamento',
            '998' => '998 - Exclusão do Demonstrativo de Pagamentos/Holerite',
            '999' => '999 - Exclusão de pagamento incluído anteriormente',
        ];

        /**
         * 001, 002, 003 - Utilizar somente quando tiver interesse que o banco verifique  se o CPF/CNPJ informado nas posições 204 a 217 do  segmento “A” pertence à Conta Corrente de Crédito no Itaú.
         * 004 - Para incluir o “Demonstrativo de Pagamentos/Holerite”, de um pagamento que já foi efetuado ou que se encontra agendado, deve-se informar:
                • Segmento “A”: Todas as informações do pagamento e Nosso Número;
                • Segmentos “D” e “E”: Todos os campos do Demonstrativo;
                • Segmento “F”: Informar apenas se houver mensagem a ser exibida.
         * 512 - Para alterar (5) um “Demonstrativo de Pagamentos/Holerite”, de um pagamento que já se encontra agendado ou já foi efetuado, deve-se informar:
                • Segmento “A”: Todas as informações do pagamento e  Nosso Número;
                • Segmentos “D” e “E”: Todos os campos do  Demonstrativo;
                • Segmento “F”: Informar apenas se houver mensagem a ser exibida
         * 517 - Para comandar a alteração do Valor de um pagamento (código 517), deve-se informar no registro de detalhe (Segmentos A, J, N ou O) os campos Código do Banco, Código do Lote, Tipo de Registro, Número do Registro, Segmento, Tipo de Movimento, novo valor do pagamento e Nosso Número.
         * 519 - Para comandar a alteração da data de um pagamento (código 519), deve-se informar no registro de detalhe (Segmentos A, J, N ou O) os campos Código do Banco, Código do Lote, Tipo de Registro, Número do Registro, Segmento, Tipo de Movimento, nova Data de Pagamento e Nosso Número.
         * 998 - Para comandar a exclusão de um “Demonstrativo de Pagamentos/Holerite”, de um pagamento que já se encontra agendado ou já foi efetuado, deve-se informar:
                • Segmento “A”: Todas as informações do pagamento e Nosso Número;
                • Segmentos “D” e “E”: Todos os campos do Demonstrativo;
                • Segmento “F”: Informar apenas se houver mensagem a ser exibida.
         * 999 - Para comandar uma exclusão (código 999), devem-se informar no registro detalhe (Segmentos A, J, N ou O), os campos Código do Banco, Código do Lote, Tipo de Registro, Número do Registro, Segmento, Tipo de Movimento e Nosso Número.
         */

        return $items;
    }


    /**
     * @notes Return types of Pix key for SISPAG Itaú
     *
     * @return string[]
     */
    public function getTipoChavePixOptions()
    {
        $items = [
            '01' => '01 - TELEFONE',
            '02' => '02 - E-MAIL',
            '03' => '03 - CPF/CNPJ',
            '04' => '04 - CHAVE ALEATÓRIA',
        ];

        return $items;
    }


    /**
     * @notes Return occurences for SISPAG Itaú
     *
     * @return string[]
     */
    public function getOcorrenciasOptions()
    {
        $items = [
            '00' => '00 - PAGAMENTO EFETUADO',
            'AE' => 'AE - DATA DE PAGAMENTO ALTERADA',
            'AG' => 'AG - NÚMERO DO LOTE INVÁLIDO',
            'AH' => 'AH - NÚMERO SEQUENCIAL DO REGISTRO NO LOTE INVÁLIDO',
            'AI' => 'AI - PRODUTO DEMONSTRATIVO DE PAGAMENTO NÃO CONTRATADO',
            'AJ' => 'AJ - TIPO DE MOVIMENTO INVÁLIDO',
            'AL' => 'AL - CÓDIGO DO BANCO FAVORECIDO INVÁLIDO',
            'AM' => 'AM - AGÊNCIA DO FAVORECIDO INVÁLIDA',
            'AN' => 'AN - CONTA CORRENTE DO FAVORECIDO INVÁLIDA',
            'AO' => 'AO - NOME DO FAVORECIDO INVÁLIDO',
            'AP' => 'AP - DATA DE PAGAMENTO / DATA DE VALIDADE / HORA DE LANÇAMENTO / ARRECADAÇÃO / APURAÇÃO INVÁLIDA',
            'AQ' => 'AQ - QUANTIDADE DE REGISTROS MAIOR QUE 999999',
            'AR' => 'AR - VALOR ARRECADADO / LANÇAMENTO INVÁLIDO',
            'BC' => 'BC - NOSSO NÚMERO INVÁLIDO',
            'BD' => 'BD - PAGAMENTO AGENDADO',
            'BE' => 'BE - PAGAMENTO AGENDADO COM FORMA ALTERADA PARA OP',
            'BI' => 'BI - CNPJ / CPF DO FAVORECIDO NO SEGMENTO J-52 ou B INVÁLIDO / DOCUMENTO FAVORECIDO INVÁLIDO PIX',
            'BL' => 'BL - VALOR DA PARCELA INVÁLIDO',
            'CD' => 'CD - CNPJ / CPF INFORMADO DIVERGENTE DO CADASTRADO',
            'CE' => 'CE - PAGAMENTO CANCELADO',
            'CF' => 'CF - VALOR DO DOCUMENTO INVÁLIDO / VALOR DIVERGENTE DO QR CODE',
            'CG' => 'CG - VALOR DO ABATIMENTO INVÁLIDO',
            'CH' => 'CH - VALOR DO DESCONTO INVÁLIDO',
            'CI' => 'CI - CNPJ / CPF / IDENTIFICADOR / INSCRIÇÃO ESTADUAL / INSCRIÇÃO NO CAD / ICMS INVÁLIDO',
            'CJ' => 'CJ - VALOR DA MULTA INVÁLIDO',
            'CK' => 'CK - TIPO DE INSCRIÇÃO INVÁLIDA',
            'CL' => 'CL - VALOR DO INSS INVÁLIDO',
            'CM' => 'CM - VALOR DO COFINS INVÁLIDO',
            'CN' => 'CN - CONTA NÃO CADASTRADA',
            'CO' => 'CO - VALOR DE OUTRAS ENTIDADES INVÁLIDO',
            'CP' => 'CP - CONFIRMAÇÃO DE OP CUMPRIDA',
            'CQ' => 'CQ - SOMA DAS FATURAS DIFERE DO PAGAMENTO',
            'CR' => 'CR - VALOR DO CSLL INVÁLIDO',
            'CS' => 'CS - DATA DE VENCIMENTO DA FATURA INVÁLIDA',
            'DA' => 'DA - NÚMERO DE DEPEND. SALÁRIO FAMILIA INVALIDO',
            'DB' => 'DB - NÚMERO DE HORAS SEMANAIS INVÁLIDO',
            'DC' => 'DC - SALÁRIO DE CONTRIBUIÇÃO INSS INVÁLIDO',
            'DD' => 'DD - SALÁRIO DE CONTRIBUIÇÃO FGTS INVÁLIDO',
            'DE' => 'DE - VALOR TOTAL DOS PROVENTOS INVÁLIDO',
            'DF' => 'DF - VALOR TOTAL DOS DESCONTOS INVÁLIDO',
            'DG' => 'DG - VALOR LÍQUIDO NÃO NUMÉRICO',
            'DH' => 'DH - VALOR LIQ. INFORMADO DIFERE DO CALCULADO',
            'DI' => 'DI - VALOR DO SALÁRIO-BASE INVÁLIDO',
            'DJ' => 'DJ - BASE DE CÁLCULO IRRF INVÁLIDA',
            'DK' => 'DK - BASE DE CÁLCULO FGTS INVÁLIDA',
            'DL' => 'DL - FORMA DE PAGAMENTO INCOMPATÍVEL COM HOLERITE',
            'DM' => 'DM - E-MAIL DO FAVORECIDO INVÁLIDO',
            'DV' => 'DV - DOC / TED DEVOLVIDO PELO BANCO FAVORECIDO',
            'D0' => 'D0 - FINALIDADE DO HOLERITE INVÁLIDA',
            'D1' => 'D1 - MÊS DE COMPETENCIA DO HOLERITE INVÁLIDA',
            'D2' => 'D2 - DIA DA COMPETENCIA DO HOLETITE INVÁLIDA',
            'D3' => 'D3 - CENTRO DE CUSTO INVÁLIDO',
            'D4' => 'D4 - CAMPO NUMÉRICO DA FUNCIONAL INVÁLIDO',
            'D5' => 'D5 - DATA INÍCIO DE FÉRIAS NÃO NUMÉRICA',
            'D6' => 'D6 - DATA INÍCIO DE FÉRIAS INCONSISTENTE',
            'D7' => 'D7 - DATA FIM DE FÉRIAS NÃO NUMÉRICO',
            'D8' => 'D8 - DATA FIM DE FÉRIAS INCONSISTENTE',
            'D9' => 'D9 - NÚMERO DE DEPENDENTES IR INVÁLIDO',
            'EM' => 'EM - CONFIRMAÇÃO DE OP EMITIDA',
            'EX' => 'EX - DEVOLUÇÃO DE OP NÃO SACADA PELO FAVORECIDO',
            'E0' => 'E0 - TIPO DE MOVIMENTO HOLERITE INVÁLIDO',
            'E1' => 'E1 - VALOR 01 DO HOLERITE / INFORME INVÁLIDO',
            'E2' => 'E2 - VALOR 02 DO HOLERITE / INFORME INVÁLIDO',
            'E3' => 'E3 - VALOR 03 DO HOLERITE / INFORME INVÁLIDO',
            'E4' => 'E4 - VALOR 04 DO HOLERITE / INFORME INVÁLIDO',
            'FC' => 'FC - PAGAMENTO EFETUADO ATRAVÉS DE FINANCIAMENTO COMPROR',
            'FD' => 'FD - PAGAMENTO EFETUADO ATRAVÉS DE FINANCIAMENTO DESCOMPROR',
            'HÁ' => 'HÁ - ERRO NO LOTE',
            'HM' => 'HM - ERRO NO REGISTRO HEADER DE ARQUIVO',
            'IB' => 'IB - VALOR DO DOCUMENTO INVÁLIDO',
            'IC' => 'IC - VALOR DO ABATIMENTO INVÁLIDO',
            'ID' => 'ID - VALOR DO DESCONTO INVÁLIDO',
            'IE' => 'IE - VALOR DA MORA INVÁLIDO',
            'IF' => 'IF - VALOR DA MULTA INVÁLIDO',
            'IG' => 'IG - VALOR DA DEDUÇÃO INVÁLIDO',
            'IH' => 'IH - VALOR DO ACRÉSCIMO INVÁLIDO',
            'II' => 'II - DATA DE VENCIMENTO INVÁLIDA / QR CODE EXPIRADO',
            'IJ' => 'IJ - COMPETÊNCIA / PERÍODO REFERÊNCIA / PARCELA INVÁLIDA',
            'IK' => 'IK - TRIBUTO NÃO LIQUIDÁVEL VIA SISPAG OU NÃO CONVENIADO COM ITAÚ',
            'IL' => 'IL - CÓDIGO DE PAGAMENTO / EMPRESA /RECEITA INVÁLIDO',
            'IM' => 'IM - TIPO X FORMA NÃO COMPATÍVEL',
            'IN' => 'IN - BANCO/AGÊNCIA NÃO CADASTRADOS',
            'IO' => 'IO - DAC / VALOR / COMPETÊNCIA / IDENTIFICADOR DO LACRE INVÁLIDO / IDENTIFICAÇÃO DO QR CODE INVÁLIDO',
            'IP' => 'IP - DAC DO CÓDIGO DE BARRAS INVÁLIDO / ERRO NA VALIDAÇÃO DO QR CODE',
            'IQ' => 'IQ - DÍVIDA ATIVA OU NÚMERO DE ETIQUETA INVÁLIDO',
            'IR' => 'IR - PAGAMENTO ALTERADO',
            'IS' => 'IS - CONCESSIONÁRIA NÃO CONVENIADA COM ITAÚ',
            'IT' => 'IT - VALOR DO TRIBUTO INVÁLIDO',
            'IU' => 'IU - VALOR DA RECEITA BRUTA ACUMULADA INVÁLIDO',
            'IV' => 'IV - NÚMERO DO DOCUMENTO ORIGEM / REFERÊNCIA INVÁLIDO',
            'IX' => 'IX - CÓDIGO DO PRODUTO INVÁLIDO',
            'LA' => 'LA - DATA DE PAGAMENTO DE UM LOTE ALTERADA',
            'LC' => 'LC - LOTE DE PAGAMENTOS CANCELADO',
            'NA' => 'NA - PAGAMENTO CANCELADO POR FALTA DE AUTORIZAÇÃO',
            'NB' => 'NB - IDENTIFICAÇÃO DO TRIBUTO INVÁLIDA',
            'NC' => 'NC - EXERCÍCIO (ANO BASE) INVÁLIDO',
            'ND' => 'ND - CÓDIGO RENAVAM NÃO ENCONTRADO/INVÁLIDO',
            'NE' => 'NE - UF INVÁLIDA',
            'NF' => 'NF - CÓDIGO DO MUNICÍPIO INVÁLIDO',
            'NG' => 'NG - PLACA INVÁLIDA',
            'NH' => 'NH - OPÇÃO/PARCELA DE PAGAMENTO INVÁLIDA',
            'NI' => 'NI - TRIBUTO JÁ FOI PAGO OU ESTÁ VENCIDO',
            'NR' => 'NR - OPERAÇÃO NÃO REALIZADA',
            'PD' => 'PD - AQUISIÇÃO CONFIRMADA (EQUIVALE A OCORRÊNCIA 02 NO LAYOUT DE RISCO SACADO)',
            'RJ' => 'RJ - REGISTRO REJEITADO',
            'RS' => 'RS - PAGAMENTO DISPONÍVEL PARA ANTECIPAÇÃO NO RISCO SACADO – MODALIDADE RISCO SACADO PÓS AUTORIZADO',
            'SS' => 'SS - PAGAMENTO CANCELADO POR INSUFICIÊNCIA DE SALDO / LIMITE DIÁRIO DE PAGTO EXCEDIDO',
            'TA' => 'TA - LOTE NÃO ACEITO - TOTAIS DO LOTE COM DIFERENÇA',
            'TI' => 'TI - TITULARIDADE INVÁLIDA',
            'X1' => 'X1 - FORMA INCOMPATÍVEL COM LAYOUT 010',
            'X2' => 'X2 - NÚMERO DA NOTA FISCAL INVÁLIDO',
            'X3' => 'X3 - IDENTIFICADOR DE NF/CNPJ INVÁLIDO',
            'X4' => 'X4 - FORMA 32 INVÁLIDA',
        ];

        return $items;
    }
}
