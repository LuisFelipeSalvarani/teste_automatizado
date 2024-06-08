void ConfigInicial() {
  parametro.limite_iniciar_umidade = 50.00;
  parametro.limite_parar_umidade = 65.00;
  parametro.limite_iniciar_temperatura = 15.00;
  parametro.limite_parar_temperatura = 30.00;
  parametro.limite_minimo_consumo = 1000.00;
  parametro.limite_maximo_consumo = 10000.00;
  parametro.hora_inicio = 6;
  parametro.minuto_inicio=0;
  parametro.hora_fim=19;
  parametro.minuto_fim=0;
  parametro.duracao = 360;
  parametro.segunda = true;
  parametro.terca = true;
  parametro.quarta = true;
  parametro.quinta = true;
  parametro.sexta = true;
  parametro.sabado = true;
  parametro.domingo = true;

  comando.automatico = true;
  comando.valvula = false;
  comando.motor = false;  
  comando.controle_temperatura = true;
  comando.controle_umidade = true;
  comando.controle_consumo = true;
}