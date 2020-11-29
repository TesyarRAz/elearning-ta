import 'package:elearning/theme.dart';
import 'package:flutter/material.dart';
import 'package:elearning/models/modul.dart';

import 'dart:math';

class ModulPage extends StatefulWidget {
  @override
  State<StatefulWidget> createState() => _ModulPageState();
}

class _ModulPageState extends State<ModulPage> {
  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
        endDrawer: Drawer(
          child: _SearchModul(),
        ),
        appBar: AppBar(
          leading: IconButton(
            icon: Icon(Icons.arrow_back),
            onPressed: () => Navigator.of(context).pop()
          ),
          title: Text('Daftar Modul'),
          actions: [
            Builder(
              builder: (context) => IconButton(
                icon: Icon(Icons.search),
                onPressed: () {
                  Scaffold.of(context).openEndDrawer();
                },
              ),
            ),
          ],
        ),
        body: GridView.count(
          crossAxisCount: min(7, (MediaQuery.of(context).size.width / 120).round()),
          children: List.generate(
            10,
            (e) => InkWell(
              onTap: () {
                Navigator.of(context).pushNamed('/modul/detail', arguments: Modul(name: "Modul #$e"));
              },
              child: Container(
                height: 150,
                padding: const EdgeInsets.all(10),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Expanded(
                      child: Placeholder(),
                    ),
                    SizedBox(height: 10),
                    Text(
                      "Modul #$e",
                      style: appTheme.textTheme.caption,
                    ),
                  ],
                ),
              ),
            ),
          ).toList(),
        ),
      ),
    );
  }
}

class _SearchModul extends StatefulWidget {
  @override
  State<StatefulWidget> createState() => _SearchModulState();
}

class _SearchModulState extends State<_SearchModul> {
  Set<int> selectedKelas = {};
  Set<String> selectedJurusan = {};
  Set<String> selectedPelajaran = {};

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.stretch,
      children: [
        Expanded(
          child: SingleChildScrollView(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Padding(
                  padding: const EdgeInsets.all(10),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text("Filter Kelas"),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [10, 11, 12].map((kelas) => RaisedButton(
                          child: Text("Kelas $kelas"),
                          onPressed: () {
                            setState(() {
                              if (selectedKelas.contains(kelas)) {
                                selectedKelas.remove(kelas);
                              } else {
                                selectedKelas.add(kelas);
                              }
                            });
                          },
                          color: selectedKelas.contains(kelas) ? Colors.blue : Colors.white,
                        )).toList()
                      ),
                    ],
                  ),
                ),
                Padding(
                  padding: const EdgeInsets.all(10),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text("Filter Jurusan"),
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          "Akutansi dan Tata Keuangan Lembaga",
                          "Bisnis Daring dan Pemasaran",
                          "Otomatisasi dan Tata Kelola Perkantoran",
                          "Rekayasa Perangkat Lunak",
                          "Teknik Komputer Jaringan",
                        ].map((jurusan) => RaisedButton(
                          child: Text(jurusan),
                          onPressed: () {
                            setState(() {
                              if (selectedJurusan.contains(jurusan)) {
                                selectedJurusan.remove(jurusan);
                              } else {
                                selectedJurusan.add(jurusan);
                              }
                            });
                          },
                          color: selectedJurusan.contains(jurusan) ? Colors.blue : Colors.white,
                        )).toList()
                      ),
                    ],
                  ),
                ),
                Padding(
                  padding: const EdgeInsets.all(10),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text("Filter Pelajaran"),
                      
                    ],
                  ),
                ),
              ]
            ),
          ),
        ),
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 10),
          child: RaisedButton(
            child: Text('Filter'),
            onPressed: () {},
          ),
        ),
      ],
    );
  }
}