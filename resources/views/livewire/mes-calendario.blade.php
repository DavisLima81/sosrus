{{--
1- O QUE DESEJO MOSTRAR NA TELA E CALENDARIO:
    - O nome (string) do mês selecionado
    - O ano (integer) selecionado
    - A tela formatada em calendário com os dias do mês selecionado, sendo que:
        - O calendário será configurado em grid, com 7 colunas e 6 linhas
        - A primeira linha será o cabeçalho, com os nomes dos dias da semana
        - A primeira coluna iniciará com a segunda-feira
        - Os dias do mês serão exibidos em cada célula do grid
        - Os dias do mês serão exibidos em cada célula do grid
        - Os dias de fim de semana e de feriado exibirão fonte em vermelho e fundo em cinza
    - Os eventos serão plotados dentro de cada célula correspondente ao dia do evento
    - Os eventos serão exibidos em forma de badge



--}}


<div>
    @if($mes_nome != null && $mes_nome != 'MES_MOUNT_SELETOR')
        <div>
            <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                <span class="py-1" wire:model.live="mes">{{ mb_strtoupper($mes_nome) }}</span>
            </div>
            <br>
            <div class="grid grid-cols-1 gap-1">
            </div>
            <div>
                <p class="py-3 text-primary-600">DADOS DO MÊS CARBON</p>
                <p>NOME DO MÊS: {{ $mes_nome }}</p>
                <p>CARBON-> INÍCIO DO MÊS: {{ $mes_primeiro_dia }}</p>
                <p>Nº PRIMEIRO DIA SEMANA DO MÊS: {{ $mes_primeiro_dia_semana }}</p>
                <p>NOME PRIMEIRO DIA SEMANA DO MÊS: {{ $mes_primeiro_dia_semana_nome }}</p>
                <p>CARBON-> FIM DO MÊS: {{ $mes_ultimo_dia }}</p>
                <br>
                <hr>
                <p class="py-3 text-primary-600">DADOS DO REGISTRO MÊS</p>
                <p>trazer os feriados e finais de semana</p>
                @foreach($feriados as $feriado)
                    <p>{{ $feriado->data }} - {{ $feriado->nome }}</p>
                @endforeach



                <br>
                <br>
            </div>
            <hr class="border-gray-600">
            {{-- region CABEÇALHO COM OS NOMES DE DIAS DA SEMANA --}}
            <div class="grid grid-cols-7 gap-1 py-1">
                <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                    <span class="py-1"><strong>SEG</strong></span>
                </div>
                <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                    <span class="py-1"><strong>TER</strong></span>
                </div>
                <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                    <span class="py-1"><strong>QUA</strong></span>
                </div>
                <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                    <span class="py-1"><strong>QUI</strong></span>
                </div>
                <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                    <span class="py-1"><strong>SEX</strong></span>
                </div>
                <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                    <span class="py-1 text-primary-400"><strong>SAB</strong></span>
                </div>
                <div class="grid h-10 flex-grow bg-gray-600 place-items-top justify-center">
                    <span class="py-1 text-primary-400"><strong>DOM</strong></span>
                </div>
            </div>
            {{-- endregion CABEÇALHO COM OS NOMES DE DIAS DA SEMANA --}}
            {{-- region DIAS DO MÊS SEMANA #1 --}}
            <div class="grid grid-cols-7 gap-1">
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 border-gray-600 px-2">
                    <p class="justify-self-center"><strong>01</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 border-gray-600 px-2">
                    <p class="self-auto"><strong>02</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 border-gray-600 px-2">
                    <p class="self-auto"><strong>03</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>04</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>05</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>06</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>07</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
            {{-- endregion DIAS DO MÊS SEMANA #1 --}}
            {{-- region DIAS DO MÊS SEMANA #2 --}}
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>08</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>09</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>10</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>11</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>12</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>13</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>14</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
            {{-- endregion DIAS DO MÊS SEMANA #2 --}}
            {{-- region DIAS DO MÊS SEMANA #3 --}}
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="justify-self-center"><strong>15</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>16</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>17</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>18</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>19</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>20</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>21</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
            {{-- endregion DIAS DO MÊS SEMANA #3 --}}
            {{-- region DIAS DO MÊS SEMANA #4 --}}
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="justify-self-center"><strong>22</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>23</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>24</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>25</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>26</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>27</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>28</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                {{-- endregion DIAS DO MÊS SEMANA #4 --}}
                {{-- region DIAS DO MÊS SEMANA #5 --}}
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>29</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                <div class="h-40 overflow-y-auto bg-base-100 place-items-top border-b border-gray-600 px-2">
                    <p class="self-auto"><strong>30</strong></p>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SBJR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SDHL</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">SAR</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">AMD</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">ATC</a>
                    <a href="#" class="text-blue-400 badge py-0 my-1 hover:bg-gray-100">COV</a>
                </div>
                {{-- endregion DIAS DO MÊS SEMANA #5 --}}
            </div>
        </div>
    @endif()

</div>
