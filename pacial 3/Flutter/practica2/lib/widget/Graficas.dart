import 'package:flutter/material.dart';
import 'dart:convert';
import 'dart:async';
import 'package:http/http.dart' as http;
import 'package:fl_chart/fl_chart.dart';

class Graficas extends StatefulWidget {
  const Graficas({super.key});

  @override
  State<StatefulWidget> createState() {
    return Clase();
  }
}

class Clase extends State<Graficas> {
  List<double> datosgrafica = [];
  bool cargando = true;
  Timer? timer;

  get htpp => null;

  @override
  void initState() {
    super.initState();
    obtenerDatos();
    timer = Timer.periodic(const Duration(seconds: 3), (timer) {
      obtenerDatos();
    });
  }

  @override
  void dispose() {
    timer?.cancel();
    super.dispose();
  }

  Future obtenerDatos() async {
    try {
      final url = Uri.parse("http://192.168.1.11:8000/api/sensores");
      final respuesta =
          await htpp.get(url).timeout(const Duration(seconds: 10));
      if (respuesta.statusCode == 200) {
        final dynamic datos = json.decode(respuesta.body);
        if (datos is List) {
          setState(() {
            final todosdatos = datos.map<double>((item) {
              if (item is num) return item.toDouble();
              return double.tryParse(item.toString()) ?? 0.0;
            }).toList();
            datosgrafica = todosdatos.length > 10
                ? todosdatos.sublist(todosdatos.length - 5)
                : todosdatos;
            cargando = false;
          });
        }
      }
    } catch (e) {
      print('Error: $e');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Graficas',
          style: TextStyle(
            color: Colors.white,
          ),
        ),
        backgroundColor: Colors.grey,
      ),
      body: cargando
          ? Center(child: CircularProgressIndicator())
          : Padding(
              padding: EdgeInsets.all(10),
              child: Column(
                children: [
                  Card(
                    elevation: 15,
                    child: Padding(
                      padding: EdgeInsets.all(5),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Column(
                            children: [
                              Text("Datos a grafiar"),
                              Text(" ${datosgrafica.length}"),
                            ],
                          ),
                          Column(
                            children: [
                              Text("Ultimo dato"),
                              Text(
                                  "${datosgrafica.isNotEmpty ? datosgrafica.last.toStringAsFixed(1) : '0'}"),
                            ],
                          ),
                          Column(
                            children: [
                              Text("Primer dato"),
                              Text(
                                  "${datosgrafica.isNotEmpty ? datosgrafica.first.toStringAsFixed(1) : '0'}"),
                            ],
                          ),
                        ],
                      ),
                    ),
                  ),
                  //debajo del Card
                  Expanded(
                    child: BarChart(
                      BarChartData(
                        minY: 0,
                        maxY: datosgrafica.isNotEmpty
                            ? datosgrafica.reduce((a, b) => a > b ? a : b) * 1.2
                            : 100,
                        barGroups: datosgrafica.asMap().entries.map((entry) {
                          final indice = entry.key;
                          final valor = entry.value;
                          return BarChartGroupData(
                            x: indice,
                            barRods: [
                              BarChartRodData(
                                toY: valor,
                                color: Colors.amberAccent,
                                width: 15,
                                borderRadius: BorderRadius.circular(5),
                              ),
                            ],
                          );
                        }).toList(),
                        titlesData: FlTitlesData(
                          bottomTitles: AxisTitles(
                            sideTitles: SideTitles(
                              showTitles: true,
                              getTitlesWidget: (value, meta) {
                                return Text('${value.toInt() + 1}');
                              },
                            ),
                          ),
                          leftTitles: AxisTitles(
                            sideTitles: SideTitles(
                              showTitles: true,
                              getTitlesWidget: (value, meta) {
                                return Text('${value.toInt()}');
                              },
                            ),
                          ),
                        ),
                        gridData: FlGridData(show: true),
                        borderData: FlBorderData(show: true),
                      ),
                    ),
                  ),
                  Expanded(
                    child: LineChart(
                      LineChartData(
                        minY: 0,
                        maxY: 100,
                        lineBarsData: [
                          LineChartBarData(
                            spots: [
                              for (int i = 0; i < datosgrafica.length; i++)
                                FlSpot(i.toDouble(), datosgrafica[i])
                            ],
                            isCurved: true,
                            color: Colors.red,
                            barWidth: 3,
                            dotData: FlDotData(show: false),
                          ),
                          LineChartBarData(
                            spots: [
                              for (int i = 0; i < datosgrafica.length; i++)
                                FlSpot(i.toDouble(), datosgrafica[i])
                            ],
                            isCurved: true,
                            color: Colors.blue,
                            barWidth: 3,
                            dotData: FlDotData(show: false),
                          ),
                        ],
                        titlesData: FlTitlesData(
                          bottomTitles: AxisTitles(
                            sideTitles: SideTitles(showTitles: false),
                          ),
                          leftTitles: AxisTitles(
                            sideTitles: SideTitles(showTitles: true),
                          ),
                        ),
                        gridData: FlGridData(show: true),
                        borderData: FlBorderData(show: true),
                      ),
                    ),
                  ),
                  Expanded(
                    child: PieChart(
                      PieChartData(
                        sections: () {
                          if (datosgrafica.isEmpty)
                            return <PieChartSectionData>[];

                          final total = datosgrafica.reduce((a, b) => a + b);

                          return datosgrafica.map<PieChartSectionData>((item) {
                            final valor = item;
                            final porcentaje =
                                total > 0 ? (valor / total) * 100 : 0;

                            return PieChartSectionData(
                              value: valor,
                              color: Colors.blue,
                              title: '${porcentaje.toStringAsFixed(1)}%',
                              radius: 50,
                              titleStyle: const TextStyle(
                                fontSize: 14,
                                fontWeight: FontWeight.bold,
                                color: Colors.white,
                              ),
                            );
                          }).toList();
                        }(),
                        centerSpaceRadius: 30,
                        sectionsSpace: 2,
                      ),
                    ),
                  ),
                ],
              ),
            ),
    );
  }
}
