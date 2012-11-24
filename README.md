FujiminoSignageViewClient
=========================


var defaultInput = {
theme : 'waiting',
message : 'ほげほげさんがコミットしました。<br />テストは<span style="color:red">失敗</span>しました。'
};
themeの引数は'committed', 'failed', 'succeed'のどれかが使えます


Githubからはコミットに応じてcommitedメッセージを受け取る。


Travis からはテストの succeed failedを受け取る。

