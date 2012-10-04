class CreateQuestions < ActiveRecord::Migration
  def change
    create_table :questions do |t|
      t.integer :id
      t.string :title
      t.text :value
      t.integer :type_id
      t.integer :poll_id
      t.timestamps
    end
  end
end
