class CreateTypes < ActiveRecord::Migration
  def change
    create_table :types do |t|
      t.integer :id
      t.string :title
      t.timestamps
    end
  end
end
