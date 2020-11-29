import 'package:flutter/material.dart';

import 'package:elearning/models/modul.dart';

class DetailModulPage extends StatelessWidget {
	Modul modul;

	DetailModulPage({ this.modul });

	@override
	Widget build(BuildContext context) {
		return SafeArea(
			child: Scaffold(
				appBar: AppBar(
					title: Text('Detail Modul')
				),
				body: SingleChildScrollView(
					child: Column(
						children: [
							
						]
					)
				)
			)
		);
	}
}