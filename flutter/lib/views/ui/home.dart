import 'package:elearning/theme.dart';
import 'package:flutter/material.dart';

import 'dart:math';

class HomePage extends StatefulWidget {
  @override
  State<StatefulWidget> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
        body: SingleChildScrollView(
          child: Column(
            children: [
              Stack(
                children: [
                  Container(
                    height: 200,
                    color: Colors.blue,
                  ),
                  Padding(
                    padding: const EdgeInsets.fromLTRB(10, 10, 10, 10),
                    child: Column(
                      children: [
                        Card(
                          child: Container(
                            padding: const EdgeInsets.all(10),
                            child: Column(
                              children: [
                                Row(
                                  mainAxisAlignment:
                                      MainAxisAlignment.spaceBetween,
                                  children: [
                                    Text("Nama: Budi Sanjaya"),
                                    IconButton(
                                      icon: Icon(Icons.settings),
                                      onPressed: () {},
                                    )
                                  ],
                                ),
                              ],
                            ),
                          ),
                        ),
                        SizedBox(height: 20),
                        buildGrupMenu(),
                        SizedBox(height: 20),
                        buildRekomendasiModul(),
                        SizedBox(height: 20),
                        buildRekomendasiPengajar(),
                      ],
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
        bottomNavigationBar: BottomNavigationBar(
          items: [
            BottomNavigationBarItem(
              label: 'Beranda',
              icon: Icon(Icons.home),
            ),
            BottomNavigationBarItem(
              label: 'Profile',
              icon: Icon(Icons.home),
            ),
          ],
        ),
      ),
    );
  }

  Widget buildGrupMenu() => Card(
        child: Container(
          height: 150,
          padding: const EdgeInsets.all(10),
          child: GridView.count(
            crossAxisCount: 1,
            scrollDirection: Axis.horizontal,
            // Kalau udah siap, pindahin ini ke initState
            children: [
              _GrupMenuItem(
                title: "Modul",
                onTap: () {
                  Navigator.of(context).pushNamed("/modul");
                },
              ),
              _GrupMenuItem(
                title: "Pengajar",
              ),
              _GrupMenuItem(
                title: "Nilai",
              ),
            ]
                .map(
                  (e) => InkWell(
                    onTap: e.onTap ?? () {},
                    child: Container(
                      width: 75,
                      padding: const EdgeInsets.all(10),
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Expanded(
                            child: Placeholder(),
                          ),
                          SizedBox(height: 10),
                          Text(
                            e.title,
                            style: TextStyle(
                              fontSize: 10,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                )
                .toList(),
          ),
        ),
      );

  Widget buildRekomendasiModul() => Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Padding(
            padding: const EdgeInsets.only(left: 8.0),
            child: Text(
              'Rekomendasi Modul',
              style: appTheme.textTheme.subtitle2.apply(color: Colors.grey),
            ),
          ),
          Card(
            child: Container(
              padding: const EdgeInsets.all(10),
              child: GridView.count(
                crossAxisCount: min(5, (MediaQuery.of(context).size.width / 150).round()),
                shrinkWrap: true,
                children: List.generate(
                  10,
                  (e) => InkWell(
                    onTap: () {},
                    child: Container(
                      height: 100,
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
          ),
        ],
      );
  Widget buildRekomendasiPengajar() => Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Padding(
            padding: const EdgeInsets.only(left: 8.0),
            child: Text(
              'Rekomendasi Pengajar',
              style: appTheme.textTheme.subtitle2.apply(color: Colors.grey),
            ),
          ),
          Card(
            child: Container(
              padding: const EdgeInsets.all(10),
              child: GridView.count(
                shrinkWrap: true,
                crossAxisCount: min(7, (MediaQuery.of(context).size.width / 120).round()),
                children: List.generate(
                  10,
                  (e) => InkWell(
                    onTap: () {},
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
                            "Pengajar #$e",
                            style: appTheme.textTheme.caption,
                          ),
                        ],
                      ),
                    ),
                  ),
                ).toList(),
              ),
            ),
          ),
        ],
      );
}

class _GrupMenuItem {
  String title;
  String image;
  Function onTap;

  _GrupMenuItem({
    this.title,
    this.image,
    this.onTap,
  });
}
