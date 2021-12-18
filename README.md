# IslamQA Core Plugin

## Introduction

A WordPress Plugin that creates CRUD operations on fatwa custom post type using the WPGraphQL API. The implementation includes registering custom post type and making it hookable by WPGraphQL, adding custom fields, in addition, making these custom fields available to different CRUD operations.
The plugin was implemented to be compliant with the code architecture of the WPGraphQL open-source plugin.

## Fatwa Operations

- [x] Register CPT.
- [x] (C) createFatwa
- [x] (R) fatwa / fatwas
- [x] (U) updateFatwa
- [x] (D) deleteFatwa
- [X] Store additional post meta data

## Test GraphQL Schema

```graphql
query getFatwa {
  fatwa(id: "cG9zdDoyNg==", idType: ID) {
    id
    databaseId
    title
    content
    status
  }
}

query getFatwas {
  fatwas {
    nodes {
      title
      id
      databaseId
      uri
      slug
      fatwaNumber
    }
  }
}

mutation createFatwa {
  createFatwa(
    input: {
      title: "ولاية الأب الشيعي على ابنته التي أصبحت من أهل السنة؟", 
      content: """
      الحمد لله.

أولا :

إن كان والدها لا يفعل شيئا من الأمور الشركية التي يفعلها كثير من الشيعة، كدعاء أهل البيت والاستغاثة بهم، أو كان من العوام الذين لا علم عندهم، ويفعلون هذه الأشياء تقليدا لعلمائهم، فإن القول بعذره في هذه الحالة قوي، فلا يحكم عليه بالكفر .

وينظر لبيان مسألة العذر بالجهل الأسئلة رقم:(10065)، (111362)، (153830)، (215338).

وفي هاتين الحالتين يصح أن يكون وليا لابنته في النكاح .

ثانيا :

أما إن كان أفراد عائلتها المنتسبون لطائفة الشيعة متلبسين بأمور كفرية صريحة كما هو حال غلاة الرافضة، ويرفضون الإقلاع عنها بعد بيانها لهم، فلا يصح في هذه الحال أن يكون واحد منهم وليا لهذه المرأة المسلمة؛ لأن الواجب أن يكون ولي المرأة المسلمة مسلما.

قال ابن قدامة رحمه الله تعالى:

" أما الكافر فلا ولاية له على مسلمة بحال، بإجماع أهل العلم، منهم؛ مالك، والشافعي، وأبو عبيد، وأصحاب الرأي. وقال ابن المنذر: أجمع على هذا كل من نحفظ عنه من أهل العلم " انتهى من"المغني" (9 / 377).

وفي هذه الحال تنتقل الولاية إلى من هو مناسب في مجتمع المسلمين عندكم كإمام المسجد أو مدير المركز الإسلامي أو رجل صالح من جيرانها، ونحو هذا.

قال شيخ الإسلام ابن تيمية رحمه الله تعالى:

" فإذا لم يكن له عصبة زوج الحاكم باتفاق العلماء " انتهى من "مجموع الفتاوى" (32 / 33).

وقال ابن عبد البر رحمه الله تعالى:

" فإذا كانت المرأة بموضع لا سلطان فيه، ولا ولي لها؛ فإنها تُصَيِّر أمرها إلى من يوثق به من جيرانها، فيزوجها ويكون هو وليها في هذه الحال؛ لأن الناس لا بد لهم من التزويج، وإنما يعملون فيه بأحسن ما يمكن " انتهى من "التمهيد" (19 / 93).

وحينئذ، إن تم عقد النكاح بولاية والدها فإنه يعاد مرة أخرى بإمام المسجد، وحضور شاهدين، والأمر في هذا هين؛ فإنه لا يلزم أن تكون هذه "الإعادة" علنا أمام الناس، ولا أن يكون في محفل يحضره أحد؛ فقط يكون إمام المسجد هو الولي، ومعك شاهدان من أهل ثقتك، لتصحيح الأمر قبل الدخول. وتكون قضيت حاجتك، وتزوجت المرأة السنية، وأخرجتها من بيئتها الشيعية، ثم احتطت لأمر نكاحك، واطمأننت إلى صحة العقد. والحمد لله .

والله أعلم.
      """,
      fatwaNumber: "111111",
      status: PUBLISH
    }
  ) {
    fatwa {
      id
      databaseId
      title
      content
      status
      fatwaNumber
      fatwaQuestions {
        question
      }
    }
  }
}

mutation updateFatwa {
  updateFatwa(
    input: {
      id: "cG9zdDoyOA==", 
      title: "هل يجوز الحصول على لعبة بطريق غير رسمي لأن بها موسيقى ؟"
      content: """
      الحمد لله.

أولا:

حقوق الابتكار والاختراع للألعاب وغيرها محترمة، فلا يجوز العدوان عليها، وكون اللعبة مشتملة على موسيقى لا يسقط حق صاحبها، فإن بقية المنفعة معتبرة.

وقد صدر عن مجمع الفقه الإسلامي قرار بخصوص الحقوق المعنوية، جاء فيه:

" ثالثاً: حقوق التأليف والاختراع أو الابتكار مصونة شرعاً، ولأصحابها حق التصرف فيها، ولا يجوز الاعتداء عليها " انتهى من "مجلة المجمع" (ع 5، ج 3 ص 2267).

ثانيا:

حرمة الاعتداء على الحقوق تشمل المسلم ، والكافر المعصوم ، وهو المعاهد والذمي والمستأمن، وأما الحربي فلا حرمة لماله.

والحربي من كان من دولة محاربة ، وهي من ليس بينها وبين الدولة المسلمة عهد ولا ذمة.

جاء في "فتاوى اللجنة الدائمة للإفتاء" (13/188) : " س: أعمل في مجال الحاسب الآلي، ومنذ أن بدأت العمل في هذا المجال أقوم بنسخ البرامج للعمل عليها، ويتم ذلك دون أن أشتري النسخ الأصلية لهذه البرامج، علما بأنه توجد على هذه البرامج عبارات تحذيرية من النسخ، مؤداها: أن حقوق النسخ محفوظة، تشبه عبارة (حقوق الطبع محفوظة) الموجودة على بعض الكتب، وقد يكون صاحب البرنامج مسلما أو كافرا. وسؤالي هو: هل يجوز النسخ بهذه الطريقة أم لا؟

ج: لا يجوز نسخ البرامج التي يمنع أصحابها نسخها ، إلا بإذنهم ؛ لقوله صلى الله عليه وسلم : " المسلمون على شروطهم " ، ولقوله صلى الله عليه وسلم : " لا يحلّ مال امرئ مسلم إلا بطيبة من نفسه " ، وقوله صلى الله عليه وسلم : " من سبق إلى مباح فهو أحقّ به " .

سواء كان صاحب هذه البرامج مسلما أو كافرا غير حربي؛ لأنّ حقّ الكافر غير الحربيّ محترم كحقّ المسلم . والله أعلم .

اللجنة الدائمة للبحوث العلمية والإفتاء

الشيخ بكر أبو زيد، الشيخ صالح الفوزان ، الشيخ عبد العزيز آل الشيخ ، الشيخ عبد العزيز بن باز " انتهى

ثالثا:

إذا حصلت على اللعبة بطريقة مشروعة، وأمكن إغلاق صوت الموسيقى، جاز اللعب بها؛ لانتفاء المحذور.

والله أعلم.
      """,
      fatwaNumber: "XYZ456"
    }
  ) {
    fatwa {
      id
      databaseId
      title
      content
      fatwaNumber
      status
    }
  }
}

mutation deleteFatwa {
  deleteFatwa(input: { id: "cG9zdDoyOA=="}) {
    fatwa {
      id
      title
    }
  }
}
```

## References

- [https://github.com/wp-graphql/wp-graphql](https://github.com/wp-graphql/wp-graphql)
- [https://github.com/kellenmace/wpgraphql-post-type-crud-operations](https://github.com/kellenmace/wpgraphql-post-type-crud-operations)
- [https://github.com/kellenmace/wordpress-plugin-boilerplate](https://github.com/kellenmace/wordpress-plugin-boilerplate)

## License

[LICENSE](LICENSE)