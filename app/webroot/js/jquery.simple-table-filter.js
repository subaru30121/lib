;(function($){
	$.fn.simpleTableFilter = function(option){

		//オプション設定
		option = $.extend({
			autoFiltering : true
		},option);

		return this.each(function(){

			//table 要素の取得
			var target = $(this);

			//--------------------------------------------------------------
			//フィルタリング処理の実装とテーブルへのバインド
			//--------------------------------------------------------------

			target.on('table-filtering',function(){

				//tr でループ
				$(this).find('> tbody > tr').each(function(){

					//一旦 tr を表示状態にする
					var tr = $(this).show();

					//td でループ
					$(this).find('> *').each(function(index){

						//対応するフィルタを取得
						var filter = option.filters[index];

						//フィルタの割り当てられてるか？
						if(filter){

							//jQuery オブジェクト化
							filter = $(filter);

							//td の値を小文字化して取得
							var data = $(this).text().toLowerCase();

							//フィルタの値を小文字化して取得
							var filter_val = filter.val().toLowerCase();

							//ラジオボタンの場合は選択された要素から値を取得
							if(filter.prop('type') == 'radio'){
								var filter_val = filter.filter(':checked').val().toLowerCase();
							}

							//フィルタの値が td の値に含まれてなかったら
							if(data.indexOf(filter_val) < 0){

								//tr を非表示にして
								tr.hide();

								//td のループを抜ける
								return false;
							}
						}

					});
				});
			});

			//--------------------------------------------------------------
			//条件入力フィールドに変更があったらフィルタリング処理を起動する
			//--------------------------------------------------------------

			//自動フィルタリングオプションが有効の場合のみバインドする
			if(option.autoFiltering){

				//条件入力フィールドでループ
				for(var i in option.filters){

					//キー入力後のフィルタリング処理を遅延実行させるためのタイマー変数
					var timer;

					//フィルタ条件入力時
					$(option.filters[i]).on('keydown change',function(){

						//直近のキー入力による実行待ちのフィルタリング処理をキャンセル
						if(timer) clearTimeout(timer);

						//300ms 後のフィルタリング実行を予約
						timer = setTimeout(function(){
							target.trigger('table-filtering');
						},300);
					});
				}
			}

			//フィルタリングの実行
			target.trigger('table-filtering');

		});
	}
})(jQuery);
