class Response<T> {
  int code;
  T data;
  String message;

  Response({this.code, this.data, this.message});

  Response.fromMap(Map<String, dynamic> map, T Function(dynamic) dataConverter)
      : this(
          code: map['code'],
          data:
              dataConverter != null ? dataConverter(map['data']) : map['data'],
          message: map['message'],
        );
}
